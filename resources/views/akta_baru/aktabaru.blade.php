<div class="card p-4">
    <form action="{{ route('akta_baru.store') }}" method="post" enctype="multipart/form-data" id="form_akta_baru">
        @csrf
        <div class="form-body">
            <div class="row">
                <div class="col">
                    <div class="form-group mb-4">
                        <label for="badan_usaha">Badan Usaha<b class="text-danger">*</b></label>
                        <select class="form-control @error('badan_usaha') is-invalid @enderror" id="badan_usaha" name="badan_usaha">
                            <option value="">-Pilih Badan Usaha-</option>
                            @foreach ($badan_usaha as $badan_usaha)
                                <option value="{{ $badan_usaha->id }}">{{ $badan_usaha->name }} - {{ $badan_usaha->abbreviation }}</option>
                            @endforeach
                        </select>
                        @error('badan_usaha')
                            <span class="text-danger">{{ $message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mb-4">
                        <label for="jenis_akta">Jenis Akta<b class="text-danger">*</b></label>
                        <select class="form-control @error('jenis_akta') is-invalid @enderror" id="jenis_akta" name="jenis_akta">
                            <option value="">-Pilih Jenis Akta-</option>
                            @foreach ($jenis_akta as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->name }}</option>
                            @endforeach
                        </select>
                        @error('jenis_akta')
                            <span class="text-danger">{{ $message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="nomor_akta">Nomor Akta<b class="text-danger">*</b></label>
                        <input class="form-control @error('nomor_akta') is-invalid @enderror" type="number" name="nomor_akta" id="nomor_akta">
                        @error('nomor_akta')
                            <span class="text-danger">{{ $message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="tanggal_akta">Tanggal Akta<b class="text-danger">*</b></label>
                        <input class="form-control @error('tanggal_akta') is-invalid @enderror" type="date" name="tanggal_akta" id="tanggal_akta">
                        @error('tanggal_akta')
                            <span class="text-danger">{{ $message}}</span>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="nama_usaha">Nama Usaha<b class="text-danger">*</b></label>
                <input class="form-control @error('nama_usaha') is-invalid @enderror" type="text" name="nama_usaha" id="nama_usaha">
                @error('nama_usaha')
                    <span class="text-danger">{{ $message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat">Alamat<b class="text-danger">*</b></label>
                <input class="form-control @error('alamat') is-invalid @enderror" type="text" name="alamat" id="alamat">
                @error('alamat')
                    <span class="text-danger">{{ $message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="draft">Draft<b class="text-danger">*</b></label>
                <input class="form-control @error('draft') is-invalid @enderror" type="file" name="draft" id="draft">
                @error('draft')
                    <span class="text-danger">{{ $message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="ckeditor form-control" name="deskripsi" id="deskripsi"></textarea>
            </div>
        </div>
        <div class="form-action float-right">
            <a class="btn btn-rounded btn-light" href="{{ route('akta_baru.index') }}">Batal</a>
            <button class="btn btn-rounded btn-primary" type="submit" name="submit">Simpan</button>
        </div>
    </form>
</div>

@section('js')
    <script>

        $(document).ready(function() {
            // $('.js-example').select2();
            // $('.js-example-basic-single').select2();

            if($("#alert-status").length > 0){
                setTimeout(() => {
                    $('#alert-status').alert('close');
                }, 3000);
            }
        });

    </script>
@endsection
