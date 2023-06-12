<?php

namespace App\Http\Controllers;

use App\Models\Akta;
use App\Models\AktaKeluar;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Stroage;
use Illuminate\Support\Facades\File;


class AktaKeluarController extends Controller
{

    public function index()
    {
        $akta_keluar = AktaKeluar::orderBy('created_at', 'DESC')
            ->get();

        return view("akta_keluar.index", ['akta_keluar' => $akta_keluar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akta = Akta::all();

        return view("akta_keluar.create", [
            'akta' => $akta
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);
        DB::beginTransaction();
        try {

            $pdfFileSalinan = $request->file('salinan');
            $pdfFileNameSalinan = date('Ymdhis'). '_' . 'Salinan Akta' . '_' . $request->nama_usaha. '.' .$request->file('salinan')->getClientOriginalExtension();
            $pdfFileSalinan->move('files/salinan/', $pdfFileNameSalinan);

            $akta_keluar = AktaKeluar::create([
                'deed_id' => $request->nama_usaha,
                'name' => $request->nama,
                'no_ktp' => $request->no_ktp,
                'telephone' => $request->no_hp,
                'date_of_release' => $request->tanggal_keluar,
                'quantity' => $request->jumlah,
                'description' => $request->deskripsi,
                'new_status_deed' => ($request->status != null) ? true : false,
                'created_id' => 1,
                'updated_id' => 1,
            ]);

            if($request->status != null){
                $akta = Akta::findOrFail($request->nama_usaha);
                $akta->deed_copy = $pdfFileNameSalinan;
                $akta->save();
            }

            DB::commit();
            $status = 1;
        } catch (\Error $e) {
            DB::rollBack();
            $status = 0;
        }
        // dd($status);
        return redirect()
            ->route('akta_keluar.index')
            ->with('status', $status)
            ->with('type', 'create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AktaKeluar  $aktaKeluar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $akta_keluar = AktaKeluar::findOrFail($id);

        return view("akta_baru.show", ['akta_keluar' => $akta_keluar]);
    }
    protected function validateRequest(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required',
            'nama' => 'required',
            'no_ktp' => 'required|numeric|digits:16',
            'no_hp' => 'required|numeric|digits_between:12, 15',
            'tanggal_keluar' => 'required',
            'jumlah' => 'required',
        ],[
            'required' => ':Attribute harus diisi.',
            'numeric' => ':Attribute harus angka.',
            'digits_between' => ':Attribute harus di antara :min hingga :max digit.',
            'digits' => ':Attribute harus :digits digit.',
        ]);
    }
}
