@extends('layouts.template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">User</h2>
            </div>
            <div class="col-5 align-self-center">
                <div class="float-right">
                    <a class="btn btn-primary btn-rounded" href="{{ route('user.create') }}">Tambah User</a>
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
                            <span>Data Berhasil {{ session('type') == 'create' ? 'Ditambahkan' : (session('type') == 'update' ? 'Diperbarui' : (session('type') == 'delete' ? 'Dihapus' : '')) }} </span>
                        @else
                            <i class="fas fa-lg fa-times-circle mr-2"></i>
                            <span>Data Gagal {{ session('type') == 'create' ? 'Ditambahkan' : (session('type') == 'update' ? 'Diperbarui' : (session('type') == 'delete' ? 'Dihapus' : '')) }} </span>
                        @endif
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <div class="col-12">
                <div class="card p-4">
                    <table class="table table-responsive table-sm mb-0" id="tableUser">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Nama</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">No Hp</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $data)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->telephone }}</td>
                                    {{-- <td class="text-center"><span class="badge badge-pill badge-{{ $user->status == 1 ? 'success' : 'secondary' }}">{{ $user->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</span></td> --}}
                                    <td class="text-center">
                                        <a class="btn btn-rounded btn-warning btn-sm" href="{{ route('user.edit', ['id' => $data->id]) }}">Ubah</a>
                                        <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                                            action="{{ route('user.destroy', [$data->id]) }}" method="POST">
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
            $('#tableUser').DataTable();

            if($("#alert-status").length > 0){
                setTimeout(() => {
                    $('#alert-status').alert('close');
                }, 3000);
            }
        });
    </script>
@endsection
