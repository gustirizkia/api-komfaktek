<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarLk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DaftarLkController extends Controller
{
    public function create(Request $request)
    {
        // 'user_id', 'status_pembayara', 'nama', 'image_pribadi', 'image_ktm', 
        // 'semester', 'alamat', 'note'
        $rules = [
            'image_pribadi' => 'required|image',
            'image_ktm' => 'required|image',
            'semester' => 'required|integer',
            'alamat' => 'required|string',
            'note' => 'required|string'
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if($validator->fails())
        {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $userId = Auth::user()->id;
        $user = User::find($userId);
        $data['user_id'] = $userId;

        $image_pribadi = $request->file('image_pribadi')->store('lk1', 'public');
        $data['image_pribadi'] = url('storage/'.$image_pribadi);

        $image_ktm = $request->file('image_ktm')->store('lk1', 'public');
        $data['image_ktm'] = url('storage/'.$image_ktm);

        $daftarLk = DaftarLk::create($data);

        return response()->json([
            'success' => false,
            'message' => 'daftar lk berhasil',
            'data' => $daftarLk
        ], 200);

    }
}
