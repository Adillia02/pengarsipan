<div class="card p-4">
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
