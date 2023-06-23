@extends('layouts.template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h3>Selamat Datang, {{ Auth::user()->name }}</h3>
        </div>
    </div>
</div>
@endsection
