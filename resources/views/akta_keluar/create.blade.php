@extends('layouts.template')
@section('css')

@endsection


@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Akta Keluar</h2>
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
                    <form action="{{ route('akta_keluar.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group mb-4">
                                <label for="nama_usaha">Nama Usaha<b class="text-danger">*</b></label>
                                <select class="js-example-basic-single form-control" id="nama_usaha" name="nama_usaha">
                                    @foreach ($akta as $data)
                                        <option value="{{ $data->id }}" data-status-copy="{{ $data->deed_copy === ""  ? 'true' : 'false' }}">{{ $data->business_name }} - {{ $data->deed_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama<b class="text-danger">*</b></label>
                                <input class="form-control" type="text" name="nama" id="nama">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="no_ktp">No KTP<b class="text-danger">*</b></label>
                                        <input class="form-control" type="number" name="no_ktp" id="no_ktp">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="no_hp">No HP<b class="text-danger">*</b></label>
                                        <input class="form-control" type="number" name="no_hp" id="no_hp">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal_keluar">Tanggal Akta Keluar<b class="text-danger">*</b></label>
                                        <input class="form-control" type="date" name="tanggal_keluar" id="tanggal_keluar">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah Salinan<b class="text-danger">*</b></label>
                                        <input class="form-control" type="number" name="jumlah" id="jumlah">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="status"
                                        id="status" value="1">
                                    <label for="status" class="custom-control-label">Salinan Pertama</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salinan">Salinan<b class="text-danger">*</b></label>
                                <input class="form-control" type="file" name="salinan" id="salinan">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="ckeditor form-control" name="deskripsi" id="deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="form-action float-right">
                            <a class="btn btn-rounded btn-light" href="{{ route('akta_keluar.index') }}">Batal</a>
                            <button class="btn btn-rounded btn-primary" type="submit" name="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            firstCopy($("#nama_usaha").find(":selected").data('status-copy'));

            $("#nama_usaha").on("change", function(e){                // firstCopy(this.data('status-copy'));
                firstCopy(this.data('status-copy'));
            });

            function firstCopy(value){
                if(value === true){
                    $("#status").removeAttr('disabled');
                }else{
                    $("#status").prop('disabled', true);
                    $("#status").prop('checked', false);
                }
            }

        });


    </script>
@endsection
