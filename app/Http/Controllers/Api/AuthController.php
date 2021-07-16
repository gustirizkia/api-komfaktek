<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
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

        $email = $request->input('email');
        $password = $request->input('password');
        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            $user = Auth::user();
            $token = $user->createToken('myToken')->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'login berhasil',
                'token' => $token
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'unathorized' 
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required',
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

        $data['password'] = Hash::make($request->input('password'));
        $user = User::create($data);
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'register berhasil',
            'data' => $user,
            'token' => $token
        ], 200);
    }
}
