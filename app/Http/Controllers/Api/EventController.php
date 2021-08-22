<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Kategori;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $data = Event::with('pemateri')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'list event',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = Event::with('pemateri', 'moderator.user.user_detail')->withCount('joinEvent')->find($id);
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'detail event',
            'data' => $data
        ], 200);
    }

    public function kategoriAll()
    {
        $data = Kategori::get();

        return response()->json([
            'success' => true,
            'message' => 'list kategori',
            'data' => $data
        ], 200);
    }

    public function kategori($id)
    {
        $kategori = Kategori::with('event')->find($id);
        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'data kategori not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'get data by kategori',
            'data' => $kategori
        ], 200);
    }
}
