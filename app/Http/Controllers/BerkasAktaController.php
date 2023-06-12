<?php

namespace App\Http\Controllers;

use App\Models\Akta;
use App\Models\BadanUsaha;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Stroage;

class BerkasAktaController extends Controller
{
    
    public function index()
    {
        $badan_usaha = BadanUsaha::orderBy('id')->get();

        return view("berkas_akta.index", ['badan_usaha' => $badan_usaha]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akta = Akta::all();

        return view("akta_keluar.create", ['akta' => $akta]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $pdfFileSalinan = $request->file('salinan');
            $pdfFileNameSalinan = date('Ymdhis'). '_' . 'Salinan Akta' . '_' . $request->nama_usaha. '.' .$request->file('salinan')->getClientOriginalExtension();
            $pdfFileSalinan->move('files/salinan/', $pdfFileNameSalinan);

            $akta_keluar = AktaKeluar::create([
                'deed_id' => $request->id_akta, 
                'name' => $request->nama,
                'no_ktp' => $request->no_ktp,
                'no_hp' => $request->no_hp,
                'date_of_release' => $request->tanggal,
                'quantity' => $request->jumlah,
                'description' => $request->deskripsi,
                'new_status_deed' => ($request->status != null) ? true : false,
                'created_id' => 1,
                'updated_id' => 1,
            ]);

            if($request->status != null){
                $akta = Akta::findOrFail($request->id_akta);
                $akta->deed_copy = $pdfFileNameSalinan;
                $akta->save();
            }
            
            DB::commit();
            $status = 1;
        } catch (\Error $e) {
            DB::rollBack();
            $status = 0;
        }

        return redirect()
            ->route('akta_keluar.index')
            ->with('status', $status)
            ->with('type', 'create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Akta $akta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $akta = Akta::findOrFail($id);

        return view("berkas_akta.show", ['akta' => $akta]);
    }
}
