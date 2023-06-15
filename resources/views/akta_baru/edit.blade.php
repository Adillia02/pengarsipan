@extends('layouts.template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Akta</h2>
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
                    <form action="{{ route('akta_baru.update', ['id' => $akta->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-4">
                                        <label for="badan_usaha">Badan Usaha<b class="text-danger">*</b></label>
                                        <select class="form-control @error('badan_usaha') is-invalid @enderror" id="badan_usaha" name="badan_usaha">
                                            <option value="">-Pilih Badan Usaha-</option>
                                            @foreach ($badan_usaha as $badan_usaha)
                                                <option
                                                    value="{{ $badan_usaha->id }}"{{ $akta->business_entity_id == $badan_usaha->id ? 'selected' : null }}>
                                                    {{ $badan_usaha->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('badan_usaha')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4">
                                        <label for="jenis_akta">Jenis Akta<b class="text-danger">*</b></label>
                                        <select class="form-control @error('jenis_akta') is-invalid @enderror" id="jenis_akta" name="jenis_akta">
                                            <option value="">-Pilih Jenis Akta-</option>
                                            @foreach ($jenis_akta as $jenis)
                                                <option
                                                    value="{{ $jenis->id }}"{{ old('id') == $jenis->id ? 'selected' : null }}>
                                                    {{ $jenis->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_akta')
                                            <span class="text-danger">{{ $message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nomor_akta">Nomor Akta<b class="text-danger">*</b></label>
                                        <input class="form-control @error('nomor_akta') is-invalid @enderror" type="number" name="nomor_akta" id="nomor_akta"
                                            value="{{ $akta->deed_number }}">
                                            @error('nomor_akta')
                                                <span class="text-danger">{{ $message}}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal_akta">Tanggal Akta<b class="text-danger">*</b></label>
                                        <input class="form-control @error('tanggal_akta') is-invalid @enderror" type="date" name="tanggal_akta" id="tanggal_akta"
                                            value="{{ $akta->deed_date }}">
                                            @error('tanggal_akta')
                                                <span class="text-danger">{{ $message}}</span>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_usaha">Nama Usaha<b class="text-danger">*</b></label>
                                <input class="form-control @error('nama_usaha') is-invalid @enderror" type="text" name="nama_usaha" id="nama_usaha"
                                    value="{{ $akta->business_name }}">
                                    @error('nama_usaha')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat<b class="text-danger">*</b></label>
                                <input class="form-control @error('alamat') is-invalid @enderror" type="text" name="alamat" id="alamat"
                                    value="{{ $akta->address }}">
                                    @error('alamat')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="draft">Draft</label>
                                <input class="form-control @error('draft') is-invalid @enderror" type="file" name="draft" id="draft">
                                <span id="file-name-display">{{ $akta->deed_draft }}</span>
                                {{-- @error('nama')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror --}}
                            </div>
                            {{-- <div class="row">
                                <div class="col">
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="salinan">Salinan</label>
                                        <input class="form-control" type="file" name="salinan" id="salinan">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="ckeditor form-control" name="deskripsi" id="deskripsi">{{ $akta->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-action float-right">
                            <a class="btn btn-rounded btn-light" href="{{ route('akta_baru.index') }}">Batal</a>
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
        CKEDITOR.replace('deskripsi');
    </script>
@endsection
