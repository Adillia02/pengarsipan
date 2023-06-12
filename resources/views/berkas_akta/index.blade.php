@extends('layouts.template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Berkas Akta</h2>
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

            <div class="col-12 flex-row">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @foreach ($badan_usaha as $data)
                        <a class="nav-item nav-link {{ $loop->iteration == 1 ? 'active' : '' }}" id="nav-{{ $data->id }}-tab" data-toggle="tab" href="#nav-{{ $data->id }}" role="tab"
                            aria-controls="nav-{{ $data->id }}" aria-selected="true">{{ $data->name }}</a>
                        @endforeach
                        
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    @foreach ($badan_usaha as $data)
                        <div class="tab-pane fade {{ $loop->iteration == 1 ? 'show active' : '' }}" id="nav-{{ $data->id }}" role="tabpanel" aria-labelledby="nav-{{ $data->id }}-tab">
                            <div class="card p-4">
                                <table class="table table-responsive table-datatables">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">No</th>
                                            <th scope="col" class="text-center">Nama Usaha</th>
                                            <th scope="col" class="text-center">Alamat</th>
                                            <th scope="col" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->akta as $akta)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $akta->business_name }}</td>
                                                <td>{{ $akta->address }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-rounded btn-primary btn-sm" href="{{ route('berkas_akta.show', ['id' => $akta->id]) }}">Lihat</a>
                
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.table-datatables').DataTable();
            
            if($("#alert-status").length > 0){
                setTimeout(() => {
                    $('#alert-status').alert('close');
                }, 3000);
            }
        });
    </script>
@endsection
