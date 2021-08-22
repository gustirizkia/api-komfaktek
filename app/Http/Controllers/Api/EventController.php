<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
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
}
