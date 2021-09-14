<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarLk;
use App\Models\GagalLk;
use App\Models\Rekening;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DaftarLkController extends Controller
{
    public function index()
    {
        $data = DaftarLk::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'list data register peserta lk',
            'data' => $data
        ], 200);
    }
    public function isDaftarLk()
    {
        $userId = Auth::user()->id;
        $userIsDaftar = DaftarLk::where('user_id', $userId)->first();
        if (!$userIsDaftar) {
            return response()->json([
                'status' => 'error',
                'message' => 'user belum daftar lk 1',

            ], 400);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'user sudah daftar lk',
                'data' => $userIsDaftar
            ], 200);
        }
    }
    public function isGagalLk()
    {
        $userId = Auth::user()->id;
        $userIsDaftar = DaftarLk::where('user_id', $userId)->with('gagalLk')->first();
        if (!$userIsDaftar) {
            return response()->json([
                'status' => 'error',
                'message' => 'user belum daftar lk 1',

            ], 400);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'user sudah daftar lk',
                'data' => $userIsDaftar
            ], 200);
        }
    }
    public function create(Request $request)
    {
        // 'rekening_id', 'nama', 'email', 'nomor_wa', 'nomor_mhs', 'prodi', 'alamat', 'tgl_lahir', 'jk', 'status' 'foto_diri', 'foto_ktm', 'foto_ktp', 'foto_bukti_byr'
        $rules = [
            'foto_diri' => 'required|image',
            'foto_ktm' => 'required|image',
            'foto_bukti_byr' => 'required|image',
            'alamat' => 'required|string',
            'jk' => 'required|string',
            'prodi' => 'required|string',
            'nomor_mhs' => 'required|string',
            'nomor_wa' => 'required|string',
            'email' => 'required|string|email',
            'nama' => 'required|string',
            'rekening_id' => 'required|string',
            'smstr' => 'required|string',
            'tgl_lahir' => 'required|date',
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $rekeningId = $request->rekening_id;
        $rekening = Rekening::find($rekeningId);
        if (!$rekening) {
            return response()->json([
                'status' => 'error',
                'message' => 'rekening not found'
            ], 404);
        }

        $foto_diri = $request->file('foto_diri')->store('assets/daftarlk', 'public');
        $data['foto_diri'] = $foto_diri;
        $foto_ktm = $request->file('foto_ktm')->store('assets/daftarlk', 'public');
        $data['foto_ktm'] = $foto_ktm;
        $foto_bukti_byr = $request->file('foto_bukti_byr')->store('assets/daftarlk', 'public');
        $data['foto_bukti_byr'] = $foto_bukti_byr;
        $data['user_id'] = Auth::user()->id;
        if ($request->file('foto_ktp')) {
            $data['foto_ktp'] = $request->file('foto_ktp')->store('assets/daftarlk', 'public');
        }


        $daftarLk = DaftarLk::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil create data daftar lk',
            'data' => $daftarLk
        ], 201);
    }

    public function setSukses(Request $request)
    {
        $userId = $request->user_id;
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'user_id not found',

            ], 404);
        }

        $daftarLk = DaftarLk::where('user_id', $userId)->first();
        $daftarLk->status = 'sukses';
        $daftarLk->save();

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil set suksess peserta',
            'data' => $daftarLk
        ], 200);
    }
    public function setGagal(Request $request)
    {
        $userId = $request->user_id;
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'user_id not found',

            ], 404);
        }

        $daftarLk = DaftarLk::where('user_id', $userId)->first();
        $daftarLk->status = 'gagal';
        $daftarLk->save();

        $gagalLk = GagalLk::create([
            'daftar_lk_id' => $daftarLk->id,
            'pesan' => $request->pesan
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil set gagal peserta',
            'data' => $gagalLk
        ], 200);
    }
}
