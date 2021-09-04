<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RekeningController extends Controller
{
    public function index()
    {
        $data = Rekening::get();

        return response()->json([
            'status' => 'success',
            'message' => 'list data rekening',
            'data' => $data
        ], 200);
    }
    public function create(Request $request)
    {
        $rules = [
            'nama_bank' => 'required|string',
            'nomor_bank' => 'required|string',
            'atas_nama' => 'required|string',
        ];
        $data = $request->all();
        $validasi = Validator::make($data, $rules);
        if ($validasi->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validasi->errors()
            ], 400);
        }

        $rekening = Rekening::create($data);

        return response()->json([
            'success' => false,
            'message' => 'berhasil create rekening',
            'data' => $rekening
        ], 200);
    }
}
