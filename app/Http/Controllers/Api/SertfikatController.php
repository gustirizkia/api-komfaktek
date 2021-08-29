<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;


class SertfikatController extends Controller
{
    public function index()
    {
        // $user_id = Auth::user()->id;
        $user = User::find(1);

        $data['user'] = $user;
        // dd($data);
        // PDF::setOptions(['dpi' => 250, 'defaultFont' => 'sans-serif']);
        $path = public_path() . '/pdf/tes.pdf';
        $pdf = PDF::loadView('sertifikat', ['user' => $user])->setPaper('a4', 'landscape')->stream('download.pdf');
        // $pdf->save($path);
        // Storage::put('public/csv/name.pdf', $pdf);
        // return response()->json([
        //     'http://127.0.0.1:8000/Storage/csv/name.pdf'
        // ]);
        return $pdf->stream();
        // return PDF::loadFile(public_path() . '/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');

        // return response()->download($pdf, 'tes.pdf');
        // return response()->json('ok');

        // $dompdf = new Dompdf;
        // $dompdf->getOptions()->setChroot(public_path());
        // $dompdf->loadHtml(view('sertifikat')->render());

        // $dompdf->stream('view.pdf', ['Attachment' => false]);
    }

    public function cekSerti(Request $request)
    {
        $event_id = $request->event_id;
        $event = Event::find($event_id);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $data['user'] = $user;
        $data['event'] = $event;
        // dd($data);
        // PDF::setOptions(['dpi' => 250, 'defaultFont' => 'sans-serif']);

        $pdf = PDF::loadView('sertifikat', ['user' => $user])->setPaper('a4', 'landscape');
        $pdf->stream();

        return response()->json(url());
    }
}
