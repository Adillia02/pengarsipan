<?php

namespace App\Http\Controllers;

use App\Models\BadanUsaha;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BadanUsahaController extends Controller
{
    public function index()
    {
        Gate::authorize('isAdmin');

        $badan_usaha = BadanUsaha::orderBy('updated_at', 'DESC')
            ->get();

        return view ("badan_usaha.index", [
            'badan_usaha' => $badan_usaha
        ]);
    }

    public function create()
    {
        Gate::authorize('isAdmin');

        return view ("badan_usaha.create");
    }

    public function store(Request $request)
    {
        Gate::authorize('isAdmin');

        $this->validateRequest($request);

        DB::beginTransaction();
        try {
            $badan_usaha = BadanUsaha::create([
                'name' => $request->nama,
                'abbreviation' => $request->singkatan,
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
            ->route('badan_usaha.index')
            ->with('status', $status)
            ->with('type', 'create');
    }

    public function edit($id)
    {
        Gate::authorize('isAdmin');

        $badan_usaha = BadanUsaha::findorfail($id);

        return view('badan_usaha.edit', [
            'badan_usaha' => $badan_usaha
        ]);
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('isAdmin');

        $this->validateRequest($request);

        DB::beginTransaction();

        try {
            $badan_usaha = BadanUsaha::findorfail($id);
            $badan_usaha->name = $request->nama;
            $badan_usaha->abbreviation = $request->singkatan;
            $badan_usaha->description = $request->deskripsi;
            $badan_usaha->status = ($request->status != null) ? 1 : 0;
            $badan_usaha->updated_id = Auth::id();

            $badan_usaha->save();

            DB::commit();
            $status = 1;
        } catch (\Error $e) {

            DB::rollback();
            $status = 0;
        }

        return redirect()
            ->route('badan_usaha.index')
            ->with('status', $status)
            ->with('type', 'update');
    }

    public function destroy($id)
    {
        Gate::authorize('isAdmin');
        
        $badan_usaha = BadanUsaha::findorfail($id);
        $status = 0;

        if($badan_usaha->akta->count() === 0){
            $badan_usaha->delete();
            $status = 1;
        }

        return redirect()
            ->route('badan_usaha.index')
            ->with('status', $status)
            ->with('type', 'destroy');

    }

    protected function validateRequest(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'singkatan' => 'required',
        ],[
            'required' => ':Attribute harus diisi.',
        ]);
    }

    public function showPage()
    {
        $breadcrumb = [
            ['title' => 'Dashboard', 'url' => route('home')],
            ['title' => 'Current Page', 'url' => route('badan_usaha')],
            // ['title' => 'Current Page', 'url' => null],
        ];

        return view('badan_usaha.index', compact('breadcrumb'));
    }

}
