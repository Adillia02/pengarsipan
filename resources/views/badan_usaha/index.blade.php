@extends('layouts.template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Badan Usaha</h2>
            </div>
            <div class="col-5 align-self-center">
            <div class="float-right">
                <a class="btn btn-primary btn-rounded" href="{{ route('badan_usaha.create') }}">
                    <i class="fas fa-plus"></i>
                    Tambah Badan Usaha</a>
            </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">

            @if (session('status'))
                <div class="col-12 mb-3">
                    <div id="alert-status"
                        class="alert text-white {{ session('status') == 1 ? 'alert-success bg-success' : 'alert-danger bg-danger' }} alert-dismissible fade show">
                        @if (session('status') == 1)
                            <i class="fas fa-lg fa-check-circle mr-2"></i>
                            <span>Data Berhasil @if (session('type') == 'create')
                                    Ditambahkan
                                @elseif(session('type') == 'update')
                                    Diperbarui
                                @else
                                    Dihapus
                                @endif
                            </span>
                        @else
                            <i class="fas fa-lg fa-times-circle mr-2"></i>
                            <span>Data Gagal @if (session('type') == 'create')
                                    Ditambahkan
                                @elseif(session('type') == 'update')
                                    Diperbarui
                                @else
                                    Dihapus
                                @endif
                            </span>
                        @endif
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

<div class="col-12">
    <div class="card p-4">
        <table class="table table-responsive table-sm mb-0" id="tableJabatan">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Badan Usaha</th>
                    <th scope="col" class="text-center">Singkatan</th>
                    <th scope="col" class="text-center">Deskripsi</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($badan_usaha as $data)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->abbreviation }}</td>
                        <td>{{ $data->description }}</td>
                        <td class="text-center"><span
                                class="badge badge-pill badge-{{ $data->status == 1 ? 'success' : 'secondary' }}">{{ $data->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</span>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-rounded btn-warning btn-sm"
                                href="{{ route('badan_usaha.edit', ['id' => $data->id]) }}"><i
                                    class="fas fa-edit" title="ubah"> </i> Ubah</a>
                            @if ($data->akta->count() === 0)
                                <form
                                    onsubmit="return confirm('Anda yakin hapus badan usaha {{ $data->name }}?')"
                                    class="d-inline"
                                    action="{{ route('badan_usaha.destroy', ['id' => $data->id]) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" value="Hapus"
                                        class="btn btn-rounded btn-danger btn-sm">
                                        <i class="fas fa-edit" title="ubah"> </i> Hapus
                                    </button>
                                </form>
                            @endif
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

            if ($("#alert-status").length > 0) {
                setTimeout(() => {
                    $('#alert-status').alert('close');
                }, 3000);
            }
        });
    </script>
@endsection
