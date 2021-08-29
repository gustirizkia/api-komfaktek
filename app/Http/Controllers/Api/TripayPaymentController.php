<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use App\Models\OrangBaik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class TripayPaymentController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'fund_id' => 'integer|required',
            'current_amout' => 'integer|required',
            'payment_method' => 'required|string|in:ALFAMART,ALFAMIDI,BNIVA,BRIVA,BCAVA,MANDIRIVA',
        ];
        $data = $request->all();
        $messages = [
            'in' => ':attribute harus di isi kode antara berikut (ALFAMART, ALFAMIDI, BNIVA, BRIVA, BCAVA, MANDIRIVA)',
        ];
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $fundId = $request->fund_id;
        $fund = Fund::find($fundId);

        $userId = Auth::user()->id;
        $user = User::find($userId);

        $orangBaik = OrangBaik::create([
            'user_id' => $userId,
            'fund_id' => $fundId,
            'current_amout' => $request->current_amout
        ]);

        $apiKey = env('TRIPAY_API_KEY');
        $privateKey = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = 'T3328';
        $merchantRef = $orangBaik->id;
        $amount = $request->current_amout;

        $data = [
            'method'            => $data['payment_method'],
            'merchant_ref'      => $merchantRef,
            'amount'            => $amount,
            'customer_name'     => $user->name,
            'customer_email'    => $user->email,
            'customer_phone'    => '081234567890',
            'order_items'       => [
                [
                    'sku'       => 'Galang Dana',
                    'name'      => $fund->judul,
                    'price'     => $amount,
                    'quantity'  => 1
                ]
            ],
            'callback_url'      => 'https://hmi-komfaktek.vercel.app/callback',
            'return_url'        => 'https://hmi-komfaktek.vercel.app/',
            'expired_time'      => (time() + (24 * 60 * 60)), // 24 jam
            'signature'         => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey
        ])->post('https://tripay.co.id/api-sandbox/transaction/create', $data);

        $orangBaik->reference = $response['data']['reference'];
        $orangBaik->snap_url = $response['data']['checkout_url'];
        $orangBaik->payment_method = $response['data']['payment_method'];
        $orangBaik->payment_name = $response['data']['payment_name'];
        $orangBaik->payment_name = $response['data']['payment_name'];
        $orangBaik->pay_code = $response['data']['pay_code'];
        $orangBaik->cara_bayar = $response['data']['instructions'];
        $orangBaik->metadata = $response['data'];

        $orangBaik->save();

        return response()->json([
            'success' => true,
            'message' => 'berhasil membuat transaksi via tripay',
            'data' => $orangBaik
        ], 200);
    }
}
