@extends('layouts.template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Persyaratan</h2>
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
                    <form action="{{ route('persyaratan.update',['id' => $persyaratan->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                            <label for="jenis_akta">Jenis Akta<b class="text-danger">*</b></label>
                            <select class="form-control @error('jenis_akta') is-invalid @enderror" id="jenis_akta" name="jenis_akta">
                                <option value="">-Pilih Jenis Akta-</option>

                                @foreach ($jenis_akta as $jenis)
                                    <option value="{{ $jenis->id }}"{{ $persyaratan->jenis_akta->id == $jenis->id ? ' selected' : '' }}>{{ $jenis->name }}</option>
                                @endforeach
                            </select>
                            @error('jenis_akta')
                                    <span class="text-danger">{{ $message}}</span>
                            @enderror
                        </div>
                        <div class="form-body">
                            <div class="form-group">
                                <label for="nama">Nama<b class="text-danger">*</b></label>
                                <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" id="nama" value="{{ $persyaratan->name }}">
                                @error('nama')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="ckeditor form-control" name="deskripsi" id="deskripsi">{{ $persyaratan->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="status" id="status" value="1" {{ $persyaratan->status == 1 ? 'checked' : '' }}>
                                    <label for="status" class="custom-control-label">Aktif</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-action float-right">
                            <a class="btn btn-rounded btn-light" href="{{ route('persyaratan.index') }}">Batal</a>
                            <button class="btn btn-rounded btn-primary" type="submit" name="submit">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
@endsection
