@extends('layouts.template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Jabatan</h2>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="float-right">
                    <a class="btn btn-primary btn-rounded" href="{{ route('jabatan.create') }}">Tambah Jabatan</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            
            @if(session('status'))
                <div class="col-12 mb-3">
                    <div id="alert-status" class="alert text-white {{ session('status') == 1 ? 'alert-success bg-success' : 'alert-danger bg-danger' }} alert-dismissible fade show">
                        @if (session('status') == 1)
                            <i class="fas fa-lg fa-check-circle mr-2"></i>
                            <span>Data Berhasil {{ session('type') == 'create' ? 'Ditambahkan' : 'Diperbarui' }}</span>
                        @else
                            <i class="fas fa-lg fa-times-circle mr-2"></i>
                            <span>Data Gagal {{ session('type') == 'create' ? 'Ditambahkan' : 'Diperbarui' }}</span>
                        @endif
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <div class="col-12">
                <div class="card p-4">
                    <table class="table table-sm mb-0" id="tableJabatan">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Jabatan</th>
                                <th scope="col" class="text-center">Deskripsi</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jabatan as $jabatan)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $jabatan->name }}</td>
                                    <td>{{ $jabatan->description }}</td>
                                    <td class="text-center"><span class="badge badge-pill badge-{{ $jabatan->status == 1 ? 'success' : 'secondary' }}">{{ $jabatan->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                                    <td class="text-center">
                                        <a class="btn btn-rounded btn-warning btn-sm" href="{{ route('jabatan.edit', ['id' => $jabatan->id]) }}">Ubah</a>
                                        <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                                            action="{{ route('jabatan.destroy', [$jabatan->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" value="Hapus" class="btn btn-rounded btn-danger btn-sm">

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#tableJabatan').DataTable();
            
            if($("#alert-status").length > 0){
                setTimeout(() => {
                    $('#alert-status').alert('close');
                }, 3000);
            }
        });
    </script>
@endsection
