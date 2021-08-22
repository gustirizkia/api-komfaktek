<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->with('user_detail', 'tulisan')->first();
        return response()->json([
            'success' => true,
            'message' => 'get data profile berhasil',
            'data' => $user
        ], 200);
    }
}
