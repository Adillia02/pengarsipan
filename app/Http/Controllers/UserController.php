<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('isAdmin');
        $user = User::all();

        return view ("user.index", ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('isAdmin');
        $jabatan = Jabatan::all();
        return view ("user.create");
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
        Gate::authorize('isAdmin');
        DB::beginTransaction();
        try {

            $pass_hashed = Hash::make($request->password);

            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'telephone' => $request->no_hp,
                'username' => $request->username,
                'password' =>  $pass_hashed,
                'role' => $request->jabatan,
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
            ->route('user.index')
            ->with('status', $status)
            ->with('type', 'create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorfail($id);
        $jabatan = Jabatan::all();

        return view('user.edit',['user' => $user, 'jabatan' => $jabatan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $user = User::findorfail($id);
            $user->name = $request->nama;
            // $user->positions_id = $request->jabatan;
            $user->email =  $request->email;
            $user->telephone = $request->no_hp;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->role = $request->jabatan;
            $user->updated_id = Auth::id();

            $user->save();

            DB::commit();
            $status = 1;
        } catch (\Error $e) {

            DB::rollback();
            $status = 0;
        }

        return redirect()
            ->route('user.index')
            ->with('status', $status)
            ->with('type', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $user = User::findorfail($id);

            $user->delete();

            DB::commit();
            $status = 1;
        } catch (\Error $e) {

            DB::rollback();
            $status = 0;
        }

        return redirect()
            ->route('user.index')
            ->with('status', $status)
            ->with('type', 'delete');
    }

    protected function validateRequest(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required|numeric|digits_between:12,15',
            'username' => 'required',
            'password' => 'required',
        ],[
            'required' => ':Attribute harus diisi.',
            'email' => 'Format :attribute tidak valid.',
            'numeric' => ':Attribute harus angka.',
            'digits_between' => ':Attribute harus di antara :min hingga :max digit.',
        ]);
    }
}
