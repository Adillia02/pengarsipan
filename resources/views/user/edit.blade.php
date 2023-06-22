@extends('layouts.template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Kategori</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <form action="{{ route('user.update',['id' => $user->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-4">
                                        <label for="nama">Nama Lengkap <b class="text-danger">*</b></label>
                                        <input class="form-control" type="text" name="nama" id="nama" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4">
                                        <label for="email">Email <b class="text-danger">*</b></label>
                                        <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="username">Username <b class="text-danger">*</b></label>
                                        <input class="form-control" type="text" name="username" id="username" value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="password">Password <b class="text-danger">*</b></label>
                                        <div class="input-group">
                                            <input class="form-control" type="password" name="password" id="password" value="">
                                            <a class="input-group-text show-password"><i class="fas fa-eye-slash text-secondary"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No HP <b class="text-danger">*</b></label>
                                <input class="form-control" type="number" name="no_hp" id="no_hp" value="{{ $user->telephone }}">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan <b class="text-danger">*</b></label>
                                <select class="js-example-basic-single form-control" id="jabatan" name="jabatan">
                                    <option {{ $user->role == 'staff' ? 'selected' : '' }} value="staff">Staff</option>
                                    <option {{ $user->role == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                                    <option {{ $user->role == 'owner' ? 'selected' : '' }} value="owner">Owner</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-action float-right">
                            <a class="btn btn-rounded btn-light" href="{{ route('user.index') }}">Batal</a>
                            <button class="btn btn-rounded btn-primary" type="submit" name="submit">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
