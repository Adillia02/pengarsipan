{{-- @section('css')
    <link href="{{ asset('dist/css/select2.min.css') }}" rel="stylesheet">
@endsection  --}}


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

    <form action="{{ route('akta_baru.storePenghadap') }}" method="post" enctype="multipart/form-data" id="form_penghadap">
        @csrf
        <div class="form-body">
            <div class="form-group mb-4">
                <label for="akta">Nama Usaha<b class="text-danger">*</b></label><br>
                <select class="form-control js-example" id="akta" name="akta" style="width:100%">
                    @foreach ($akta_baru as $data)
                        <option value="{{ $data->id }}">{{ $data->business_name }} - {{ $data->deed_number }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="nama_penghadap">Nama Penghadap<b class="text-danger">*</b></label>
                        <input class="form-control" type="text" name="nama_penghadap" id="nama_penghadap">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="penghadap_sebagai">Penghadap Sebagai<b class="text-danger">*</b></label>
                        <select class="form-control" id="penghadap_sebagai" name="penghadap_sebagai">
                                <option value="Penghadap 1">Penghadap 1</option>
                                <option value="Penghadap 2">Penghadap 2</option>
                                <option value="Penghadap 3">Penghadap 3</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="file_penghadap">Persyaratan<b class="text-danger">*</b></label><br>
                <input class="form-control" type="file" name="file_penghadap" id="file_penghadap">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="ckeditor form-control" name="deskripsi" id="deskripsi"></textarea>
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
        $(document).ready(function() {

            if($("#alert-status").length > 0){
                setTimeout(() => {
                    $('#alert-status').alert('close');
                }, 3000);
            }
        });


    </script>


@endsection
