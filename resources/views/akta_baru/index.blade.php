@extends('layouts.template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Akta Baru</h2>
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
                    <a class="btn btn-primary btn-rounded" href="{{ route('akta_baru.create') }}">
                        <i class="fas fa-plus"></i>
                         Tambah Akta Baru
                    </a>
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
                            <span>Data Berhasil @if (session('type') == 'create') Ditambahkan @elseif(session('type') == 'update') Diperbarui @else Dihapus @endif</span>
                        @else
                            <i class="fas fa-lg fa-times-circle mr-2"></i>
                            <span>Data Gagal @if (session('type') == 'create') Ditambahkan @elseif(session('type') == 'update') Diperbarui @else Dihapus @endif</span>
                        @endif
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <div class="col-12">
                <div class="card p-4">
                    <table class="table table-responsive w-100" id="tableJenisAkta">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Nomor Akta</th>
                                <th scope="col" class="text-center">Nama Usaha</th>
                                <th scope="col" class="text-center">Tanggal Akta</th>
                                <th scope="col" class="text-center">Alamat</th>
                                {{-- <th scope="col" class="text-center">Jenis Akta</th> --}}
                                {{-- <th scope="col" class="text-center">Badan Usaha</th> --}}
                                {{-- <th scope="col" class="text-center">Draft Akta</th>
                                <th scope="col" class="text-center">Salinan Akta</th>
                                <th scope="col" class="text-center">Status</th> --}}
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akta as $akta)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $akta->deed_number }}</td>
                                    <td>{{ $akta->business_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($akta->deed_date)->isoformat('D MMMM Y') }}</td>
                                    <td>{{ $akta->address }}</td>
                                    {{-- <td>{{ $akta->jenis_akta->name }} <span class="badge badge-pill badge-primary">{{ $akta->badan_usaha->name }}</span></td> --}}
                                    {{-- <td>{{ $akta->badan_usaha->name }}</td> --}}
                                    {{-- <td>{{ $akta->deed_draft }}</td> --}}
                                    {{-- <td>{{ $akta->deed_copy }}</td> --}}
                                    {{-- <td class="text-center"><span class="badge badge-pill badge-{{ $akta->status == 1 ? 'success' : 'secondary' }}">{{ $akta->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</span></td> --}}
                                    <td class="text-center">
                                        <a class="btn btn-rounded btn-warning btn-sm" href="{{ route('akta_baru.edit', ['id' => $akta->id]) }}">Ubah</a>
                                        {{-- <a class="btn btn-rounded btn-primary btn-sm" href="{{ route('akta_baru.show', ['id' => $akta->id]) }}">Lihat</a> --}}
                                        <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                                            action="{{ route('akta_baru.destroy', [$akta->id]) }}" method="POST">
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
            $('#tableJenisAkta').DataTable();

            if($("#alert-status").length > 0){
                setTimeout(() => {
                    $('#alert-status').alert('close');
                }, 3000);
            }
        });
    </script>
@endsection
