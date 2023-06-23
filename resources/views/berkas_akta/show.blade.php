@extends('layouts.template')
@section('css')

@endsection


@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Berkas <?= $akta->business_name ?></h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <table class="table table-striped table-sm">
                        <tbody class="text-left">
                            <tr>
                                <th>
                                    <p class="text-dark font-weight-600">Nama Usaha</p>
                                </th>
                                <td>
                                    <p><?= $akta->business_name?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <p class="text-dark font-weight-600">Alamat Usaha</p>
                                </th>
                                <td>
                                    <p><?= $akta->address?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <p class="text-dark font-weight-600">Nomor Akta</p>
                                </th>
                                <td>
                                    <p><?= $akta->deed_number?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <p class="text-dark font-weight-600">Tanggal Akta</p>
                                </th>
                                <td>
                                    <p><?= $akta->deed_date?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <p class="text-dark font-weight-600">Nama Penghadap</p>
                                </th>
                                <td>
                                    <ol type="1">
                                        @foreach ($akta->penghadap as $penghadap)
                                        <li>{{ $penghadap->name }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
{{--
                                    <p class="text-dark font-weight-600">Bukti Pemeriksaan</p>
                                    <?php if (!empty($layanan_kesehatan[0]->url_hasil)) : ?>
                                        <iframe src="<?php echo site_url($layanan_kesehatan[0]->url_hasil); ?>" width="100%" height="500" frameborder="0"></iframe>
                                    <?php else : ?>

                                    <?php endif; ?> --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex-row">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                                    aria-controls="nav-home" aria-selected="true">Draf Akta</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">Salinan Akta</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                                    aria-controls="nav-contact" aria-selected="false">Lampiran Persyaratan</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            @php
                                $file_path_draft = public_path('files/draft/'.$akta->deed_draft);
                                $file_exists_draft = Storage::exists($file_path_draft);
                            @endphp
                                @if (!$file_exists_draft)
                                <div class="float-right mt-3">
                                    <a class="btn btn-info btn-sm" href="{{ asset('files/draft/'.$akta->deed_draft) }}" download>
                                        <i class="fas fa-download"></i>
                                        Download
                                    </a>
                                    <a class="btn btn-secondary btn-sm" href="javascript:void(0);" onclick="printFile('{{ asset('files/draft/'.$akta->deed_draft) }}')">
                                        <i class="fas fa-print"></i>
                                        Cetak
                                    </a>
                                </div>
                                @endif

                                @if (!$file_exists_draft)
                                    <iframe height="700" width="100%" src="{{asset('files/draft/'.$akta->deed_draft)}}" frameborder="0" class="mt-4 mb-4"></iframe>
                                @else
                                    <p class="mt-5">File tidak tersedia.</p>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                @php
                                    $file_path_salinan = public_path('files/salinan/'.$akta->deed_copy);
                                    $file_exists_salinan = Storage::exists($file_path_salinan);
                                @endphp
                                @if ($file_exists_salinan)
                                <div class="float-right mt-3">
                                    <a class="btn btn-info btn-sm" href="{{ route('akta_baru.create') }}">
                                        <i class="fas fa-download"></i>
                                            Download
                                    </a>
                                    <a class="btn btn-secondary btn-sm" href="{{ route('akta_baru.create') }}">
                                        <i class="fas fa-print"></i>
                                            Cetak
                                    </a>
                                </div>
                                @endif
                                @if (!$file_exists_salinan)
                                    <p class="mt-5">File tidak tersedia.</p>
                                @else
                                    <iframe height="700" width="100%" src="{{ asset('files/salinan/'.$akta->deed_copy) }}" frameborder="0" class="mt-4 mb-4"></iframe>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="float-right mt-3">
                                    <a class="btn btn-info btn-sm" href="{{ route('akta_baru.create') }}">
                                        <i class="fas fa-download"></i>
                                            Download
                                    </a>
                                    <a class="btn btn-secondary btn-sm" href="{{ route('akta_baru.create') }}">
                                        <i class="fas fa-print"></i>
                                            Cetak
                                    </a>
                                </div>
                                <iframe height="700" width="100%" src="{{asset('files/draft/'.$akta->deed_draft)}}" frameborder="0" class="mt-4 mb-4"></iframe>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function printFile(fileUrl) {
            var printWindow = window.open(fileUrl, '_blank');
            printWindow.print();
        }
    </script>
@endsection
