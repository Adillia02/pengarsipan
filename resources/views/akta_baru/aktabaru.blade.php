<div class="card p-4">
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



    <form action="{{ route('akta_baru.store') }}" method="post" enctype="multipart/form-data" id="form_akta_baru">
        @csrf
        <div class="form-body">
            <div class="row">
                <div class="col">
                    <div class="form-group mb-4">
                        <label for="badan_usaha">Badan Usaha<b class="text-danger">*</b></label>
                        <select class="form-control" id="badan_usaha" name="badan_usaha">
                            <option value="">--Pilih Badan Usaha--</option>
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
                        <select class="form-control" id="jenis_akta" name="jenis_akta">
                            <option value="">--Pilih Badan Usaha--</option>
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
                        <input class="form-control" type="number" name="nomor_akta" id="nomor_akta">
                        @error('nomor_akta')
                            <span class="text-danger">{{ $message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="tanggal_akta">Tanggal Akta<b class="text-danger">*</b></label>
                        <input class="form-control" type="date" name="tanggal_akta" id="tanggal_akta">
                        @error('tanggal_akta')
                            <span class="text-danger">{{ $message}}</span>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="nama_usaha">Nama Usaha<b class="text-danger">*</b></label>
                <input class="form-control" type="text" name="nama_usaha" id="nama_usaha">
                @error('nama_usaha')
                    <span class="text-danger">{{ $message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat">Alamat<b class="text-danger">*</b></label>
                <input class="form-control" type="text" name="alamat" id="alamat">
                @error('alamat')
                    <span class="text-danger">{{ $message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="draft">Draft<b class="text-danger">*</b></label>
                <input class="form-control" type="file" name="draft" id="draft">
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

            if($("#alert-status").length > 0){
                setTimeout(() => {
                    $('#alert-status').alert('close');
                }, 3000);
            }
            // $('[name="akta"]').on('change', pilihUsaha);
            // $('#akta').on('change', function() {
            //     let aktaId = $(this).val();
            //     getJenisAkta(aktaId);
            //     console.log(aktaId);
            // });

            // function getJenisAkta(aktaId) {
            // $.ajax({
            //     url: '/get-jenis-akta', // Ganti dengan URL endpoint Anda
            //     type: 'GET',
            //     data: { aktaId: aktaId },
            //     success: function(response) {
            //         let jenisAkta = response.jenisAkta;
            //         let persyaratan = response.persyaratan;
            //         console.log(persyaratan);
            //         $('#jenis_akta').val(persyaratan);
            //     },
            //     error: function(xhr, status, error) {
            //         console.log('Terjadi kesalahan: ' + error);
            //     }
            // });
            // }
        });

        // function pilihUsaha(){
        //     // console.log($('[name="akta"]'));
        //     // let usaha = $('[name="akta"]').val();
        //     let usaha = $('[name="akta"] option:selected').text();

        //     console.log(usaha);
        // }

    </script>
@endsection
