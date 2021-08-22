<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JoinEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JoinEventController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'event_id' => 'required'
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'success',
                'message' => $validator->errors()
            ], 400);
        }
        $data['user_id'] = Auth::user()->id;

        $join_event = JoinEvent::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil join event',
            'data' => $join_event
        ]);
    }

    public function myEvent()
    {
        $userId = Auth::user()->id;
        $data = JoinEvent::where('user_id', $userId)->with('event.pemateri')->get();
        $data['count_my_event'] = $data->count();

        return response()->json([
            'status' => 'success',
            'message' => 'list event saya',
            'data' => $data
        ], 200);
    }
}
