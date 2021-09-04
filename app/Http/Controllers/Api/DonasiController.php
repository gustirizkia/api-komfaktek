<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use App\Models\OrangBaik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mockery\Undefined;

class DonasiController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'fund_id' => 'required|integer',
            'current_amout' => 'required|integer',
            'doa' => 'string',
        ];
        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $userId = Auth::user()->id;
        $user = User::find($userId);

        $fundId = $request->fund_id;
        $fund = Fund::find($fundId);
        if (!$fund) {
            return response()->json([
                'success' => false,
                'message' => 'fund id not found'
            ], 404);
        }


        $data['user_id'] = $userId;
        $data['fund_id'] = $fundId;
        $data['current_amout'] = $request->current_amout;
        if ($request->doa) {
            $data['doa'] = $request->doa;
        }
        if ($request->anonymouse) {
            $data['anonymouse'] = $request->anonymouse;
        }

        $orangBaik = OrangBaik::create($data);

        $transaction_detail = [
            'order_id' => $orangBaik->id . '-' . Str::random(5),
            'gross_amount' => $orangBaik->current_amout
        ];
        $customer_detail = [
            'first_name' => $user->name,
            'email' => $user->email,
        ];
        $item_detail = [
            [
                'id' => $orangBaik->id,
                'price' => $orangBaik->current_amout,
                'quantity' => 1,
                'name' => $fund->judul,
                'brand' => 'HMI KOMFKATEK',
                'category' => 'Donasi Galang Dana'
            ]
        ];
        $midtransParams = [
            'transaction_details' => $transaction_detail,
            'item_details' => $item_detail,
            'customer_details' => $customer_detail,
        ];
        $midtransParamsSnapUrl = $this->getMidtransSnap($midtransParams);

        $orangBaik->snap_url = $midtransParamsSnapUrl;
        $orangBaik->save();

        return response()->json([
            'success' => true,
            'message' => 'berhasil melakukan donasi',
            'data' => $orangBaik
        ], 200);
    }

    private function getMidtransSnap($params)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = (bool) env('MIDTRANS_PRODACTION');
        \Midtrans\Config::$is3ds = true;

        $snapUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
        return $snapUrl;
    }

    public function handleCallbackMidtrans(Request $request)
    {
        $data = $request->all();

        $signatureKey = $data['signature_key'];

        $orderId = $data['order_id'];
        $statusCode = $data['status_code'];
        $grossAmount = $data['gross_amount'];
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $transactionStatus = $data['transaction_status'];
        $type = $data['payment_type'];
        if (!empty($data['fraud_status'])) {
            $fraudStatus = $data['fraud_status'];
        }

        $mySignatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
        if ($signatureKey !== $mySignatureKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'invalid signature'
            ], 400);
        }

        $realOrderId = explode('-', $orderId);
        $orangBaik = OrangBaik::find($realOrderId[0]);
        if (!$orangBaik) {
            return response()->json([
                'status' => 'error',
                'message' => 'orang_baik id not found'
            ], 404);
        }
        $orangBaik->payment_method = $type;
        if ($transactionStatus === 'capture') {
            if ($fraudStatus === 'challenge') {
                $orangBaik->status_pembayaran = 'challenge';
            } elseif ($fraudStatus === 'accept') {
                $orangBaik->status_pembayaran = 'berhasil';
            }
        } elseif (
            $transactionStatus == 'cancel' ||
            $transactionStatus == 'deny' ||
            $transactionStatus == 'expire'
        ) {
            $orangBaik->status_pembayaran = 'failur';
        } elseif ($transactionStatus == 'pending') {
            $orangBaik->status_pembayaran = 'pending';
        } elseif ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            $orangBaik->status_pembayaran = 'berhasil';
        }
        $orangBaik->save();

        // update current_amout pada fund saat ada donasi baru masuk
        $fund = Fund::find($orangBaik->fund_id);
        $current_amout_update = $fund->current_amout + $orangBaik->current_amout;
        $fund->update([
            'current_amout' => $current_amout_update
        ]);

        return response()->json([
            'success' => true,
            'message' => 'pembayaran midtrans berhasil',
            'data' => $orangBaik
        ], 200);
    }

    public function myDonasi()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);

        $orangBaik = OrangBaik::where('user_id', $userId)->with('fund')->get();

        return response()->json([
            'success' => true,
            'message' => 'list donasi saya',
            'data' => $orangBaik,
        ], 200);
    }
}
