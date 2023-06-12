<?php

namespace App\Http\Controllers;

use App\Models\JenisAkta;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JenisAktaController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        Gate::authorize('isAdmin');

        $jenis_akta = JenisAkta::orderBy('updated_at','DESC')
            ->get();

        return view ("jenis_akta.index", [
            'jenis_akta' => $jenis_akta
        ]);
    }

    public function create()
    {
        Gate::authorize('isAdmin');
        return view ("jenis_akta.create");
    }

    public function store(Request $request)
    {
        Gate::authorize('isAdmin');

        $this->validateRequest($request);

        DB::beginTransaction();
        try {
            $jenis_akta = JenisAkta::create([
                'name' => $request->nama,
                'description' => $request->deskripsi,
                'status' => ($request->status != null) ? 1 : 0,
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
            ->route('jenis_akta.index')
            ->with('status', $status)
            ->with('type', 'create');
    }

    public function edit($id)
    {
        Gate::authorize('isAdmin');
        $jenis_akta = JenisAkta::findorfail($id);

        return view('jenis_akta.edit', [
            'jenis_akta' => $jenis_akta
        ]);
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('isAdmin');
        dd($request->all());

        // $this->validateRequest($request);

        DB::beginTransaction();

        try {
            $jenis_akta = JenisAkta::findorfail($id);
            $jenis_akta->name = $request->nama;
            $jenis_akta->description = $request->deskripsi;
            $jenis_akta->status = ($request->status != null) ? 1 : 0;
            $jenis_akta->updated_id = Auth::id();

            $jenis_akta->save();

            DB::commit();
            $status = 1;
        } catch (\Error $e) {

            DB::rollback();
            $status = 0;
        }

        return redirect()
            ->route('jenis_akta.index')
            ->with('status', $status)
            ->with('type', 'update');
    }

    public function destroy($id)
    {
        Gate::authorize('isAdmin');
        
        $jenis_akta = JenisAkta::findorfail($id);
        $status = 0;

        if($jenis_akta->akta->count() === 0 && $jenis_akta->persyaratan->count() === 0){
            $jenis_akta->delete();
            $status = 1;
        }

        return redirect()
            ->route('jenis_akta.index')
            ->with('status', $status)
            ->with('type', 'destroy');
    }

    protected function validateRequest(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ],[
            'required' => ':Attribute harus diisi.',
        ]);
    }

}
