<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoundRaisController extends Controller
{
    public function index()
    {
        $data = Fund::get();

        return response()->json([
            'success' => true,
            'message' => 'list data galang dana',
            'data' => $data
        ], 200);
    }

    public function detailFund($id)
    {
        $data = Fund::with('donatur', 'user.user_detail')->find($id);
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'id fun not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'detail fund',
            'data' => $data
        ], 200);
    }

    public function cari(Request $request)
    {
        $rule = [
            'keyword' => 'required|string'
        ];

        $data = $request->all();
        $validasi = Validator::make($data, $rule);
        if ($validasi->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validasi->errors()
            ], 400);
        }
        $fund = Fund::where('judul', 'like', '%' . $request->keyword . '%')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'pencarian galang dana berhasil',
            'data' => $fund
        ], 200);
    }

    public function create(Request $request)
    {
    }
}
