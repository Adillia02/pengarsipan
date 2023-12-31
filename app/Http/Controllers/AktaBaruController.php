<?php

namespace App\Http\Controllers;

use App\Models\Akta;
use App\Models\JenisAkta;
use App\Models\Penghadap;
use App\Models\BadanUsaha;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use App\Models\PersyaratanAkta;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Stroage;

class AktaBaruController extends Controller
{
    public function index()
    {
        // $jenis_akta = JenisAkta::all();
        $badan_usaha = BadanUsaha::all();
        // $allpost = Post::select('posts.*', 'users.name as author', 'users.role_id as role_id')
        //         ->leftJoin('users', 'posts.author', '=', 'users.id');

        $akta = Akta::orderBy('deed_date', 'DESC')
                    ->with('jenis_akta')
                    ->with('badan_usaha')
                    ->get();

        // $akta = Akta::select('deeds.*','types_of_deeds.name as type_name','business_entities.name as business_name')
        //         ->join('types_of_deeds', 'deeds.deed_type_id', '=', 'types_of_deeds.id')
        //         ->join('business_entities', 'deeds.business_entity_id', '=', 'business_entities.id')
        //         ->get();

        return view("akta_baru.index", [
            'akta' => $akta
        ]);
    }

    public function create()
    {
        $jenis_akta = JenisAkta::all();
        $badan_usaha = BadanUsaha::all();
        $akta_baru = Akta::all();

        return view("akta_baru.create", [
            'jenis_akta' => $jenis_akta,
            'badan_usaha' => $badan_usaha,
            'akta_baru' => $akta_baru,
            'tab' => 'akta-baru'
        ]);
    }

    // Function Akta Baru
    public function store(Request $request)
    {
        $this->validateRequest($request);

        DB::beginTransaction();
        try {
            $pdfFileDraft = $request->file('draft');
            $pdfFileNameDraft = date('Ymdhis'). '_' . 'Draft Akta' . '_' . $request->nama_usaha. '.' . $request->file('draft')->getClientOriginalExtension();
            $pdfFileDraft->move('files/draft/', $pdfFileNameDraft);

            // $pdfFileSalinan = $request->file('salinan');
            // $pdfFileNameSalinan = date('Ymdhis'). '_' . 'Salinan Akta' . '_' . $request->nama_usaha. '.' . $request->file('salinan')->getClientOriginalExtension();
            // $pdfFileSalinan->move('files/salinan/', $pdfFileNameSalinan);
            $akta = Akta::create([
                'business_entity_id' => $request->badan_usaha,
                'deed_type_id' => $request->jenis_akta,
                'deed_number' => $request->nomor_akta,
                'deed_date' => $request->tanggal_akta,
                'business_name' => $request->nama_usaha,
                'address' => $request->alamat,
                'deed_draft' => $pdfFileNameDraft,
                'deed_copy' => '',
                'description' => $request->deskripsi,
                'created_id' => Auth::id(),
                'updated_id' => Auth::id(),
            ]);

            DB::commit();
            $status = 1;
        } catch (\Error $e) {

            DB::rollBack();
            $status = 0;
        }

        return redirect()
            ->route('akta_baru.create')
            ->with('status', $status)
            ->with('type', 'create')
            ->with('tab', 'akta');


    }

    public function edit($id)
    {
        $badan_usaha = BadanUsaha::all();
        $jenis_akta = JenisAkta::all();
        $akta = Akta::findorfail($id);

        return view('akta_baru.edit',
            ['badan_usaha' => $badan_usaha,
            'jenis_akta' => $jenis_akta,
            'akta' => $akta
        ]);
    }

    public function update(Request $request, $id)
    {
        // $this->validateRequest($request);
        // dd($request->all());

        DB::beginTransaction();

        try {
            $akta = Akta::findorfail($id);

            //Hapus file lama
            // $oldSalinanPath = public_path('files/salinan/'.$akta->deed_copy);
            $oldDraftPath = public_path('files/draft/'.$akta->deed_draft);

            $pdfFileNameDraft = $akta->deed_draft;
            if ($request->hasFile('draft')) {
                $pdfFileDraft = $request->file('draft');
                $pdfFileNameDraft = date('Ymdhis'). '_' . 'Draft Akta' . '_' . $request->nama_usaha. '.' . $request->file('draft')->getClientOriginalExtension();
                $pdfFileDraft->move('files/draft/', $pdfFileNameDraft);

                if (File::exists($oldDraftPath)) {
                    File::delete($oldDraftPath);
                }
            }

            // $pdfFileNameSalinan = $akta->deed_copy;
            // if ($request->hasFile('salinan')) {
            //     $pdfFileSalinan = $request->file('salinan');
            //     $pdfFileNameSalinan = date('Ymdhis'). '_' . 'Salinan Akta' . '_' . $request->nama_usaha. '.' . $request->file('salinan')->getClientOriginalExtension();
            //     $pdfFileSalinan->move('files/salinan/', $pdfFileNameSalinan);

            //     if (File::exists($oldSalinanPath)) {
            //         File::delete($oldSalinanPath);
            //     }
            // }

            $akta->business_entity_id = $request->badan_usaha;
            $akta->deed_type_id = $request->jenis_akta;
            $akta->deed_number = $request->nomor_akta;
            $akta->deed_date = $request->tanggal_akta;
            $akta->business_name = $request->nama_usaha;
            $akta->address = $request->alamat;
            $akta->deed_draft = $pdfFileNameDraft;
            // $akta->deed_copy = $pdfFileNameSalinan;
            $akta->description = $request->deskripsi;
            $akta->created_id = 1;
            $akta->updated_id = 1;

            $akta->save();

            DB::commit();
            $status = 1;
        } catch (\Error $e) {

            DB::rollback();
            $status = 0;
        }

        return redirect()
            ->route('akta_baru.index')
            ->with('status', $status)
            ->with('type', 'update');

    }

    public function destroy($id)
    {
        $akta = Akta::findorfail($id);

        if (!empty($akta->deed_draft)) {
            $draftPath = public_path('files/draft/'.$akta->deed_draft);
            if (File::exists($draftPath)) {
                File::delete($draftPath);
            }
        }

        // Hapus data Akta
        $akta->delete();

        return redirect()->route('akta_baru.index');

    }
    // End Function Akta Baru

    // Function Penghadap
    public function storePenghadap(Request $requestPenghadap)
    {
        $this->validateRequestPenghadap($requestPenghadap);

        DB::beginTransaction();
        try {
            $kodeFile = $requestPenghadap->kode_file;
            $filePenghadap = $requestPenghadap->file_penghadap;

            $penghadap = Penghadap::create([
                'deed_id' => $requestPenghadap->akta,
                'name' => $requestPenghadap->nama_penghadap,
                'part' => $requestPenghadap->penghadap_sebagai,
                'description' => $requestPenghadap->deskripsi,
                'created_id' => Auth::id(),
                'updated_id' => Auth::id(),
            ]);

            for ($i=0; $i < count($kodeFile); $i++) {

                $persyaratan = Persyaratan::find($kodeFile[$i]);

                $pdfFileDraft = $filePenghadap[$i];
                // nama persyaratan_nama penghadap_nama pt
                $pdfFileNameDraft = $persyaratan->name . '_' . $requestPenghadap->nama_penghadap . '_' . $penghadap->akta->business_name . '.' .$filePenghadap[$i]->getClientOriginalExtension();
                $pdfFileDraft->move('files/penghadap/', $pdfFileNameDraft);

                $persyaratan_akta = PersyaratanAkta::create([
                    'attendees_id' => $penghadap->id,
                    'deed_id' => $requestPenghadap->akta,
                    'requirement_id' => $kodeFile[$i],
                    'file' => $pdfFileNameDraft,
                    'created_id' => Auth::id(),
                    'updated_id' => Auth::id(),
                ]);
            }


            DB::commit();
            $status = 1;
        } catch (\Error $e) {

            DB::rollBack();
            $status = 0;
        }

        return redirect()
            ->route('akta_baru.create')
            ->with('status', $status)
            ->with('type', 'create');
    }

    // Function Lampiran
    public function storeLampiran(Request $requestLampiran)
    {
        // $this->validateRequestPenghadap($requestLampiran);

        DB::beginTransaction();
        try {
            $kodeFile = $requestLampiran->kode_file;
            $fileLampiran = $requestLampiran->file_lampiran;

            for ($i=0; $i < count($kodeFile); $i++) {

                $persyaratan = Persyaratan::find($kodeFile[$i]);
                $akta = Akta::find($requestLampiran->nama_usaha);

                // lampiran_NPWP_nama_pt
                $pdfFileDraft = $fileLampiran[$i];
                $pdfFileNameDraft = 'Lampiran' . '_' . $persyaratan->name. '_' . $akta->business_name . '.' . $fileLampiran[$i]->getClientOriginalExtension();
                $pdfFileDraft->move('files/lampiran/', $pdfFileNameDraft);

                $persyaratan_akta = PersyaratanAkta::create([
                    'deed_id' => $requestLampiran->nama_usaha,
                    'requirement_id' => $kodeFile[$i],
                    'file' => $pdfFileNameDraft,
                    'created_id' => Auth::id(),
                    'updated_id' => Auth::id(),
                ]);
            }


            DB::commit();
            $status = 1;
        } catch (\Error $e) {

            DB::rollBack();
            $status = 0;
        }

        return redirect()
            ->route('akta_baru.create')
            ->with('status', $status)
            ->with('type', 'create');
    }

    public function show($id)
    {
        $akta = Akta::findorfail($id);

        return view("akta_baru.show", ['akta' => $akta]);

    }

    protected function validateRequest(Request $request)
    {
        $request->validate([
            'badan_usaha' => 'required',
            'jenis_akta' => 'required',
            'nomor_akta' => 'required',
            'tanggal_akta' => 'required',
            'nama_usaha' => 'required',
            'alamat' => 'required',
            'draft' => 'required',
        ],[
            'required' => ':Attribute harus diisi.',
        ]);
    }

    protected function validateRequestPenghadap(Request $request)
    {
        $request->validate([
            'akta' => 'required',
            'nama_penghadap' => 'required',
            'penghadap_sebagai' => 'required',
        ],[
            'required' => ':Attribute harus diisi.',
        ]);
    }

    public function getJenisAkta(Request $request)
    {
        $aktaId = $request->input('aktaId');

        // Mengambil data akta dari database berdasarkan ID
        $akta = Akta::find($aktaId);

        if ($akta) {
            $persyaratan = [];
                $idJenisAkta = $akta->deed_type_id;
                // $id = $jenisAkta->id;
                $persyaratan = Persyaratan::where('deed_type_id', $idJenisAkta)
                    ->where('status_personal', $request->jenis)
                    ->get();
                // var_dump($persyaratan);
            // var_dump($jenisAkta);

            // var_dump($ersyaratan);
            return response()->json(['persyaratan' => $persyaratan]);
        }

        return response()->json(['error' => 'Akta tidak ditemukan'], 404);
    }
}
