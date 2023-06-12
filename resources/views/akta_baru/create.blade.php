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
        <div class="flex-row">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link {{ $tab == 'akta' ? 'active' : '' }}" id="nav-akta-baru-tab" data-toggle="tab" href="#akta-baru" role="tab"
                        aria-controls="nav-home" aria-selected="true">Data Akta</a>
                    <a class="nav-item nav-link {{ $tab == 'penghadap' ? 'active' : '' }}" id="nav-penghadap-tab" data-toggle="tab" href="#penghadap" role="tab"
                        aria-controls="nav-profile" aria-selected="false">Penghadap</a>
                    <a class="nav-item nav-link {{ $tab == 'lampiran' ? 'active' : '' }}" id="nav-lampiran-tab" data-toggle="tab" href="#lampiran" role="tab"
                        aria-controls="nav-contact" aria-selected="false">Lampiran Persyaratan</a>
                </div>
            </nav>
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade {{ $tab == 'akta' ? 'show active' : '' }}" id="akta-baru" role="tabpanel" aria-labelledby="nav-akta-baru-tab">
                    @include('akta_baru.aktabaru')
                </div>
                <div class="tab-pane fade {{ $tab == 'penghadap' ? 'show active' : '' }}" id="penghadap" role="tabpanel" aria-labelledby="nav-penghadap-tab">
                    @include('akta_baru.penghadap')
                </div>
                <div class="tab-pane fade {{ $tab == 'lampiran' ? 'show active' : '' }}" id="lampiran" role="tabpanel" aria-labelledby="nav-lampiran-tab">
                    @include('akta_baru.lampiran')
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-example').select2();
            $('.js-example-basic-single').select2();

            if($("#alert-status").length > 0){
                setTimeout(() => {
                    $('#alert-status').alert('close');
                }, 3000);
            }
        });
    </script>
@endsection
