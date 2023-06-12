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
                                        <label for="badan_usaha">Badan Usaha</label>
                                        <select class="form-control" id="badan_usaha" name="badan_usaha">
                                            @foreach ($badan_usaha as $badan_usaha)
                                                <option
                                                    value="{{ $badan_usaha->id }}"{{ $akta->business_entity_id == $badan_usaha->id ? 'selected' : null }}>
                                                    {{ $badan_usaha->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4">
                                        <label for="jenis_akta">Jenis Akta</label>
                                        <select class="form-control" id="jenis_akta" name="jenis_akta">
                                            @foreach ($jenis_akta as $jenis)
                                                <option
                                                    value="{{ $jenis->id }}"{{ old('id') == $jenis->id ? 'selected' : null }}>
                                                    {{ $jenis->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nomor_akta">Nomor Akta</label>
                                        <input class="form-control" type="number" name="nomor_akta" id="nomor_akta"
                                            value="{{ $akta->deed_number }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal_akta">Tanggal Akta</label>
                                        <input class="form-control" type="date" name="tanggal_akta" id="tanggal_akta"
                                            value="{{ $akta->deed_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_usaha">Nama Usaha</label>
                                <input class="form-control" type="text" name="nama_usaha" id="nama_usaha"
                                    value="{{ $akta->business_name }}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input class="form-control" type="text" name="alamat" id="alamat"
                                    value="{{ $akta->address }}">
                            </div>
                            <div class="form-group">
                                <label for="draft">Draft</label>
                                <input class="form-control" type="file" name="draft" id="draft">
                                <span id="file-name-display">{{ $akta->deed_draft }}</span>
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
