@section('css')
@endsection
<div class="card p-4">
    <form action="{{ route('akta_baru.storeLampiran') }}" method="post" enctype="multipart/form-data" id="form_lampiran">
        @csrf
        <div class="form-body">
            <div class="form-group mb-4">
                <label for="nama_usaha">Nama Usaha<b class="text-danger">*</b></label>
                <select class="js-example-basic-single @error('nama_usaha') is-invalid @enderror" id="nama_usaha" name="nama_usaha" style="width:100%">
                    <option value="">-Pilih Akta-</option>
                    @foreach ($akta_baru as $akta)
                        <option value="{{ $akta->id }}">[{{ $akta->badan_usaha->name }}] - {{ $akta->business_name }} - {{ $akta->deed_number }}</option>
                    @endforeach
                </select>
                @error('nama_usaha')
                    <span class="text-danger">{{ $message}}</span>
                @enderror
            </div>
            <div id="requirment-attachment">

            </div>
        </div>
        <div class="form-action float-right mt-5">
            <a class="btn btn-rounded btn-light" href="{{ route('akta_baru.index') }}">Batal</a>
            <button class="btn btn-rounded btn-primary" type="submit" name="submit">Perbarui</button>
        </div>
    </form>
</div>

@section('js')
@endsection
@push('add-js')
    <script>
        $(document).ready(function () {
            getLampiran($('[name="nama_usaha"] option:selected').val());

            $('[name="nama_usaha"]').on('change', function() {
                let aktaId = $(this).val();
                getLampiran(aktaId);
            });

            function getLampiran(aktaId) {
                if(aktaId != ''){
                    $.ajax({
                        url: '/get-jenis-akta', // Ganti dengan URL endpoint Anda
                        type: 'GET',
                        data: {
                            aktaId: aktaId,
                            jenis: 0
                        },
                        success: function(response) {
                            let persyaratan = response.persyaratan;
                            let requirment = ``;

                            $.each(response.persyaratan, function(key, value){
                                requirment += `<div class="form-group mb-4">
                                    <label for="file_lampiran">${value.name}<b class="text-danger">*</b></label><br>
                                    <input class="form-control @error('kode_file') is-invalid @enderror" type="file" name="file_lampiran[]" id="">
                                    <input type="hidden" readonly name="kode_file[]" value="${value.id}">
                                </div>`;
                            });

                            $("#requirment-attachment").html(requirment);
                        },
                        error: function(xhr, status, error) {
                            console.log('Terjadi kesalahan: ' + error);
                        }
                    });
                }
            }
        });
    </script>
@endpush
