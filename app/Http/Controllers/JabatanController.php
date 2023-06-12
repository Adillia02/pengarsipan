<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JabatanController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        
        $jabatan = Jabatan::orderBy('updated_at','DESC')->get();

        return view ("jabatan.index",['jabatan' => $jabatan]);
    }

    public function create(){
        return view ("jabatan.create");
    }

    public function store(Request $request){

        DB::beginTransaction();
        try {
            $jabatan = Jabatan::create([
                'name' => $request->nama,
                'description' => $request->deskripsi,
                'status' => ($request->status != null) ? 1 : 0,
                'created_id' => 1,
                'updated_id' => 1,
            ]);

            DB::commit();
            $status = 1;
        } catch (\Error $e) {

            DB::rollBack();
            $status = 0;
        }

        return redirect()
            ->route('jabatan.index')
            ->with('status', $status)
            ->with('type', 'create');
    }

    public function edit($id){
        $jabatan = Jabatan::findorfail($id);

        return view('jabatan.edit',['jabatan' => $jabatan]);
    }

    public function update(Request $request, $id){

        DB::beginTransaction();

        try {
            $jabatan = Jabatan::findorfail($id);
            $jabatan->name = $request->nama;
            $jabatan->description = $request->deskripsi;
            $jabatan->status = ($request->status != null) ? 1 : 0;
            $jabatan->updated_id = 1;
    
            $jabatan->save();
            
            DB::commit();
            $status = 1;
        } catch (\Error $e) {

            DB::rollback();
            $status = 0;
        }
        
        return redirect()
            ->route('jabatan.index')
            ->with('status', $status)
            ->with('type', 'update');
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::findorfail($id);
        $jabatan->delete();

        return redirect()->route('jabatan.index');
        
    }
}
