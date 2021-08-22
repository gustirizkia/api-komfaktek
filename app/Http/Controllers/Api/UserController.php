<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile()
    {
        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->with('user_detail')->first();
        return response()->json([
            'success' => true,
            'message' => 'get data profile berhasil',
            'data' => $user
        ], 200);
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'alamat' => 'required',
            'profesi' => 'required',
            'tgl_lahir' => 'required',
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
        $user_detail = UserDetail::where('user_id', $userId)->first();

        $user_detail->update([
            'alamat' => $request->alamat,
            'profesi' => $request->profesi,
            'tgl_lahir' => $request->tgl_lahir,
        ]);

        if ($request->file('image')) {
            $image = $request->file('image')->store('assets/profile', 'public');
            $imgUrl = url('storage/' . $image);

            $user_detail->update([
                'image' => $imgUrl
            ]);
        }

        $user->update([
            'name' => $request->name
        ]);

        $data['user'] = $user;
        $data['user_detail'] = $user_detail;

        return response()->json([
            'success' => true,
            'message' => 'berhasil update profile',
            'data' => $data
        ], 200);
    }
}
