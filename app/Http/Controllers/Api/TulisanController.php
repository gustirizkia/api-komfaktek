<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriTulisan;
use App\Models\Tulisan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TulisanController extends Controller
{
    public function tulisanSaya(){
        $data = Tulisan::with('kategori', 'user')->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);

    }
    public function index()
    {
        $data = Tulisan::with('kategori', 'user')->orderBy('id', 'desc')->paginate(9);

        return response()->json([
            'success' => true,
            'message' => 'list data tulisan',
            'data' => $data
        ], 200);
    }

    public function kategori(){
        $data = KategoriTulisan::orderBy('id', 'desc')->get();
 
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => 'list kategori 01'
        ]);
    }

    public function create(Request $request)
    {
        $rules = [
            'kategori_tulisan_id' => 'required|integer',
            'judul' => 'required|string',
            'teks' => 'required',
            // 'user_id' => 'require|integer'
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
        if(!$user)
        {
            return response()->json([
                'success' => false,
                'message' => 'data user not found'
            ], 404);
        }
        $data['user_id'] = $userId;

        $kategoriId = $request->kategori_tulisan_id;
        $kategori = KategoriTulisan::find($kategoriId);
        if(!$kategori)
        {
            return response()->json([
                'success' => false,
                'message' => 'data kategori not found'
            ], 404);
        }
        if($request->file('image'))
        {
            $result = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            $data['image'] = $result;
        }

        $tulisan = Tulisan::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Tulisan berhasil di tambahkan',
            'data' => $tulisan
        ], 200);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        if ($request->file('image')) {
            $result = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            $data['image'] = $result;
        }

        $tulisan = Tulisan::where('id', $request->id)->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $tulisan
        ]);
    }

    public function show($id)
    {
        $data = Tulisan::with('user', 'kategori')->find($id);
        if(!$data)
        {
            return response()->json([
                'success' => false,
                'messagae' => 'data tulisan not found'
            ], 404);
        }

        $tulisanLainnya = Tulisan::with('user', 'kategori')->where('id', '!=', $data->id)->limit(4)->get();

        return response()->json([
            'success' => false,
            'message' => 'data detail tulisan',
            'data' => $data,
            'lainnya' => $tulisanLainnya
        ], 200);
    }

    public function delete($id)
    {
        $data = Tulisan::find($id);
        if(!$data)
        {
            return response()->json([
                'success' => false,
                'message' => 'data not found'
            ], 404);
        }

        $data->delete();
        return response()->json([
            'success' => true,
            'message' => 'data berhasil di hapus'
        ], 200);
    }
}
