@php
    $pengumuman_kelulusan = App\Models\Admin\PengumumanKelulusan::first();
@endphp
<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Resume Pendaftaran</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">resume-pendaftaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <center>

                                <h3>RESUME PENDAFTARAN</h3><br>

                                <br>

                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ asset('storage/foto_siswa/' . $pendaftaran->detail->foto) }} "
                                            style="max-width: 150px;" class="img-thumbnail" />
                                        <div class="col-md-9 ng-hide mt-2" style="border-bottom: 1px">
                                            <div class="row">
                                                <b align="center"
                                                    style="color: white;font-size: 12px; background-color: grey; padding: 20px;">
                                                    PRESTASI</b>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-12" style="border-bottom: 1px">
                                                <table class="table" align="left">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Nomor Pendaftaran</strong></td>
                                                            <td>:</td>
                                                            <td class="ng-binding">
                                                                {{ $pendaftaran->no_pendaftaran }}</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Nama Sekolah</strong></td>
                                                            <td>:</td>
                                                            <td class="ng-binding">
                                                                {{ $pendaftaran->sekolah->nama_sekolah }}</td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <td><strong>Alamat Sekolah</strong></td>
                                                            <td>:</td>
                                                            <td class="ng-binding">{{ $pendaftaran->sekolah->alamat }}
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>NIK</strong></td>
                                                            <td>:</td>
                                                            <td class="ng-binding"> 16700201230909003</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Nama Lengkap</strong></td>
                                                            <td>:</td>
                                                            <td class="ng-binding">
                                                                {{ $pendaftaran->detail->nama_lengkap }}</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Agama</strong></td>
                                                            <td>:</td>
                                                            <td class="ng-binding">
                                                                {{ $pendaftaran->detail->agama }}</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Tempat Lahir</strong></td>
                                                            <td>:</td>
                                                            <td class="ng-binding">
                                                                {{ $pendaftaran->detail->tempat_lahir }}</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Tanggal Lahir</strong></td>
                                                            <td>:</td>
                                                            <td class="ng-binding">
                                                                {{ date('d-m-Y', strtotime($pendaftaran->detail->tanggal_lahir)) }}
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Alamat Siswa</strong></td>
                                                            <td>:</td>
                                                            <td class="ng-binding"> {{ $pendaftaran->detail->alamat }}
                                                            </td>
                                                            <td></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                                <br>

                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {{-- <b style="float: left;" class="mb-2">FILE WAJIB</b> --}}
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:80%;">Surat Pengantar SD/MI (wajib)
                                                                </td>
                                                                <td>
                                                                    <a href="{{ asset('storage/data_pendaftaran/' . $pendaftaran->prestasi->surat_pengantar_sd) }}"
                                                                        target="_blank" class="btn btn-warning btn-sm">
                                                                        <i class="fa fa-eye"> Lihat</i></a>
                                                                </td>
                                                            </tr>
                                                            @if ($pendaftaran->detail->agama == 'islam')
                                                                <tr>
                                                                    <th style="width:80%;">Surat Keterangan Baca Tulis
                                                                        ALQUR'AN</th>
                                                                    <td>
                                                                        <a href="{{ asset('storage/data_pendaftaran/' . $pendaftaran->prestasi->sk_bta) }}"
                                                                            target="_blank"
                                                                            class="btn btn-primary btn-sm">
                                                                            <i class="fa fa-eye"> Lihat</i></a>
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <b style="float: left;" class="mb-2">AKADEMIK</b>
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:80%;">Nilai Raport Semester 7 s.d 11
                                                                    (wajib)</td>
                                                                <td>
                                                                    <a href="{{ asset('storage/data_pendaftaran/' . $pendaftaran->prestasi->raport) }}"
                                                                        target="_blank" class="btn btn-warning btn-sm">
                                                                        <i class="fa fa-eye"> Lihat</i></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:80%;">Akumulasi Raport
                                                                    (wajib)</td>
                                                                <td>
                                                                    <a href="{{ asset('storage/data_pendaftaran/' . $pendaftaran->prestasi->akumulasi_raport) }}"
                                                                        target="_blank" class="btn btn-warning btn-sm">
                                                                        <i class="fa fa-eye"> Lihat</i></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:80%;">Sertifikat Menang Lomba</td>
                                                                <td>
                                                                    @if ($pendaftaran->prestasi->menang_lomba == null)
                                                                        <span class="badge badge-danger">Tidak
                                                                            Memiliki</span>
                                                                    @else
                                                                        <a href="{{ asset('storage/data_pendaftaran/' . $pendaftaran->prestasi->menang_lomba) }}"
                                                                            target="_blank"
                                                                            class="btn btn-warning btn-sm">
                                                                            <i class="fa fa-eye"> Lihat</i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <b style="float: left;" class="mb-2">NON AKADEMIK</b>
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:80%;">Sertifikat Tingkat Kabupaten <br>
                                                                    <small>
                                                                        @if ($pendaftaran->prestasi->sertifikat_kabupaten != null)
                                                                            {{-- <u> Juara
                                                                                {{ $pendaftaran->prestasi->tingkat_juara_kab }}</u> --}}
                                                                        @endif
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    @if ($pendaftaran->prestasi->sertifikat_kabupaten == null)
                                                                        <span class="badge badge-danger">Tidak
                                                                            Memiliki</span>
                                                                    @else
                                                                        <a href="{{ asset('storage/data_pendaftaran/' . $pendaftaran->prestasi->sertifikat_kabupaten) }}"
                                                                            target="_blank"
                                                                            class="btn btn-warning btn-sm">
                                                                            <i class="fa fa-eye"> Lihat</i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:80%;">Sertifikat Tingkat Provinsi <br>
                                                                    <small>
                                                                        @if ($pendaftaran->prestasi->sertifikat_provinsi != null)
                                                                            {{-- <u> Juara
                                                                                {{ $pendaftaran->prestasi->tingkat_juara_prov }}</u> --}}
                                                                        @endif
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    @if ($pendaftaran->prestasi->sertifikat_provinsi == null)
                                                                        <span class="badge badge-danger">Tidak
                                                                            Memiliki</span>
                                                                    @else
                                                                        <a href="{{ asset('storage/data_pendaftaran/' . $pendaftaran->prestasi->sertifikat_provinsi) }}"
                                                                            target="_blank"
                                                                            class="btn btn-warning btn-sm">
                                                                            <i class="fa fa-eye"> Lihat</i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:80%;">Sertifikat Tingkat Nasional <br>
                                                                    <small>
                                                                        @if ($pendaftaran->prestasi->sertifikat_nasional != null)
                                                                            {{-- <u> Juara
                                                                                {{ $pendaftaran->prestasi->tingkat_juara_nas }}</u> --}}
                                                                        @endif
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    @if ($pendaftaran->prestasi->sertifikat_nasional == null)
                                                                        <span class="badge badge-danger">Tidak
                                                                            Memiliki</span>
                                                                    @else
                                                                        <a href="{{ asset('storage/data_pendaftaran/' . $pendaftaran->prestasi->sertifikat_nasional) }}"
                                                                            target="_blank"
                                                                            class="btn btn-warning btn-sm">
                                                                            <i class="fa fa-eye"> Lihat</i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:80%;">Sertifikat Tingkat Internasional
                                                                    <br>
                                                                    <small>
                                                                        @if ($pendaftaran->prestasi->sertifikat_internasional != null)
                                                                            {{-- <u> Juara
                                                                                {{ $pendaftaran->prestasi->tingkat_juara_int }}</u> --}}
                                                                        @endif
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    @if ($pendaftaran->prestasi->sertifikat_internasional == null)
                                                                        <span class="badge badge-danger">Tidak
                                                                            Memiliki</span>
                                                                    @else
                                                                        <a href="{{ asset('storage/data_pendaftaran/' . $pendaftaran->prestasi->sertifikat_internasional) }}"
                                                                            target="_blank"
                                                                            class="btn btn-warning btn-sm">
                                                                            <i class="fa fa-eye"> Lihat</i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <b style="float: left;" class="mb-2">HAFIDZ ALQUR'AN</b>
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:80%;">Surat Keterangan Dari Rumah
                                                                    Tahfidz</td>
                                                                <td>
                                                                    @if ($pendaftaran->prestasi->suket_rumah_tahfidz == null)
                                                                        <span class="badge badge-danger">Tidak
                                                                            Memiliki</span>
                                                                    @else
                                                                        <a href="{{ asset('storage/data_pendaftaran/' . $pendaftaran->prestasi->suket_rumah_tahfidz) }}"
                                                                            target="_blank"
                                                                            class="btn btn-warning btn-sm">
                                                                            <i class="fa fa-eye"> Lihat</i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($pendaftaran->prestasi->file != null)
                                            <div class="row mt-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <b style="float: left;" class="mb-2">PERSYARATAN SEKOLAH
                                                            (wajib)</b>
                                                        <table class="table">
                                                            <tbody>
                                                                @php
                                                                    $arr_pendaftaran = $pendaftaran->prestasi->file;
                                                                    $potong_awal = substr($arr_pendaftaran, 2);
                                                                    $potong_akhir = substr($potong_awal, 0, -2);
                                                                    // @dd($potong_akhir);
                                                                    $persyaratan_sekolah = explode('","', $potong_akhir);
                                                                @endphp
                                                                @foreach ($persyaratan_sekolah as $key_ps => $value)
                                                                    @php
                                                                        $potong_akhir_value = substr($value, 0, -4);
                                                                        $explode = explode('-', $potong_akhir_value);
                                                                    @endphp
                                                                    <tr>
                                                                        <td style="width:80%;">
                                                                            {{ ucwords($explode[1]) }}</td>
                                                                        <td>
                                                                            <a href="{{ asset('storage/data_pendaftaran/' . $value) }}"
                                                                                target="_blank"
                                                                                class="btn btn-warning btn-sm">
                                                                                <i class="fa fa-eye"> Lihat</i>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif



                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
            </div>

            @if ($pengumuman_kelulusan->status_pengumuman == 'ditampilkan')
                @if ($pendaftaran->status == 'ditolak')
                    <div class="alert alert-danger" role="alert">
                        <center>
                            <h4><B><u>SELEKSI PPDB</u></B></h4>
                        </center>
                        <center>MAAF <b>{{ strtoupper($pendaftaran->detail->nama_lengkap) }}</b>! ANDA <b
                                style="color:white;">TIDAK
                                LOLOS</b> SELEKSI PPDB TAHUN PELAJARAN 2023/2024
                        </center>
                        <center><b>{{ strtoupper($pendaftaran->sekolah->nama_sekolah) }}</b></center>
                    </div>
                @endif

                @if ($pendaftaran->status == 'diterima')
                    <div class="alert alert-warning dark" role="alert">
                        <center>
                            <h4><B><u>SELEKSI PPDB</u></B></h4>
                        </center>
                        <center>SELAMAT <b>{{ strtoupper($pendaftaran->detail->nama_lengkap) }}</b>! ANDA <b
                                style="color:white;">LOLOS</b> SELEKSI PPDB TAHUN PELAJARAN 2023/2024
                        </center>
                        <center><b>{{ strtoupper($pendaftaran->sekolah->nama_sekolah) }}</b></center>
                    </div>
                @endif
            @endif

        </div>
    </div>

</div>
