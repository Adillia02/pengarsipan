@extends('layouts.template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Badan Usaha</h2>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <form action="{{ route('badan_usaha.store') }}" method="post">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="nama">Nama Badan Usaha<b class="text-danger">*</b></label>
                                <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" id="nama">
                                @error('nama')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="singkatan">Singkatan<b class="text-danger">*</b></label>
                                <input class="form-control @error('singkatan') is-invalid @enderror" type="text" name="singkatan" id="singkatan">
                                @error('singkatan')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="status" id="status" value="1" checked>
                                    <label for="status" class="custom-control-label">Aktif</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-action float-right">
                            <a class="btn btn-rounded btn-light" href="{{ route('badan_usaha.index') }}">Batal</a>
                            <button class="btn btn-rounded btn-primary" type="submit" name="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
