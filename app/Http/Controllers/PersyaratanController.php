<?php

namespace App\Http\Controllers;

use App\Models\JenisAkta;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PersyaratanController extends Controller
{
    public function index()
    {
        Gate::authorize('isAdmin');
        $jenis_akta = JenisAkta::all();
        $persyaratan = Persyaratan::orderBy('updated_at','DESC')
                        ->get();

        return view ("persyaratan.index", [
            'persyaratan' => $persyaratan,
            'jenis_akta' => $jenis_akta
        ]);
    }

    public function create()
    {
        Gate::authorize('isAdmin');
        $jenis_akta = JenisAkta::all();

        return view ("persyaratan.create", [
            'jenis_akta' => $jenis_akta
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('isAdmin');

        $this->validateRequest($request);

        DB::beginTransaction();
        try {
            $persyaratan = Persyaratan::create([
                'name' => $request->nama,
                'deed_type_id' => $request->jenis_akta,
                'description' => $request->deskripsi,
                'status' => ($request->status != null) ? 1 : 0,
                'status_personal' => ($request->status_personal != null) ? true : false,
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
            ->route('persyaratan.index')
            ->with('status', $status)
            ->with('type', 'create');
    }

    public function edit($id)
    {
        Gate::authorize('isAdmin');
        $jenis_akta = JenisAkta::all();
        $persyaratan = Persyaratan::findorfail($id);

        return view('persyaratan.edit', [
            'persyaratan' => $persyaratan,
            'jenis_akta' => $jenis_akta
        ]);
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('isAdmin');
        $this->validateRequest($request);

        DB::beginTransaction();

        try {
            $persyaratan = Persyaratan::findorfail($id);
            $persyaratan->deed_type_id = $request->jenis_akta;
            $persyaratan->name = $request->nama;
            $persyaratan->description =  strip_tags($request->deskripsi, '<p><a><ul><ol><li><strong><em>');
            $persyaratan->status = ($request->status != null) ? 1 : 0;
            $persyaratan->updated_id = Auth::id();

            $persyaratan->save();

            DB::commit();
            $status = 1;
        } catch (\Error $e) {

            DB::rollback();
            $status = 0;
        }

        return redirect()
            ->route('persyaratan.index')
            ->with('status', $status)
            ->with('type', 'update');
    }

    public function destroy($id)
    {
        Gate::authorize('isAdmin');
        $persyaratan = Persyaratan::findorfail($id);
        $status = 0;

        if($persyaratan->jenis_akta->count() === 0){
            $persyaratan->delete();
            $status = 1;
        }

        return redirect()
            ->route('persyaratan.index')
            ->with('status', $status)
            ->with('type', 'destroy');

    }

    protected function validateRequest(Request $request)
    {
        $request->validate([
            'jenis_akta' => 'required',
            'nama' => 'required',
        ],[
            'required' => ':Attribute harus diisi.',
        ]);
    }
}
