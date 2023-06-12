@extends('layouts.template')
@section('content')
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
                <h3 class="text-primary">{{$akta->business_name}}</h3>
                <iframe height="700" width="100%" src="{{asset('files/draft/'.$akta->deed_draft)}}" frameborder="0" class="mb-4"></iframe>
                <iframe height="400" width="400" src="/files/salinan/{{$akta->deed_copy}}" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection