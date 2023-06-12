@section('css')
@endsection
<div class="card p-4">
    <form action="{{ route('akta_baru.store') }}" method="post" enctype="multipart/form-data" id="form_lampiran">
        @csrf
        <div class="form-body">
            <div class="form-group mb-4">
                <label for="nama_usaha">Nama Usaha<b class="text-danger">*</b></label>
                <select class="form-control js-example-basic-single" id="nama_usaha" name="nama_usaha" style="width:100%">
                    @foreach ($akta_baru as $akta)
                        <option value="{{ $akta->id }}">{{ $akta->business_name }} - {{ $akta->deed_number }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="file_persyaratan">Persyaratan<b class="text-danger">*</b></label>
                <input class="form-control" type="file" name="file_persyaratan" id="file_persyaratan">
            </div>
        </div>
        <div class="form-action float-right mt-5">
            <a class="btn btn-rounded btn-light" href="{{ route('akta_baru.index') }}">Batal</a>
            <button class="btn btn-rounded btn-primary" type="submit" name="submit">Perbarui</button>
        </div>
    </form>
</div>

@section('js')
    <script>
    </script>
@endsection
