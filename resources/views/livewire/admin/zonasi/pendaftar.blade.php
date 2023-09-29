@php
    $pengumuman_kelulusan = App\Models\Admin\PengumumanKelulusan::first();
@endphp
<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Jalur Zonasi</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">jalur-zonasi-pendaftaran</li>
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
                        <div class="row">

                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6">
                                <input style="width: 70%;float:right;" type="search" class="form-control"
                                    placeholder="Ketikan Nama Siswa" wire:model="search">
                            </div>
                        </div>
                    </div>
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
                        <div class="table-responsive">
                            <table class="table table-striped" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>No Pendaftar</th>
                                        <th>Sekolah Asal</th>
                                        <th>Lat & Long</th>
                                        <th>Jarak</th>
                                        <th>Usia KK</th>
                                        <th>Detail</th>
                                        @if ($pengumuman_kelulusan->status_pengumuman != 'ditampilkan')
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($data_zonasi as $key_data_zonasi)
                                        {{-- @dd($key_data_zonasi->zonasi) --}}
                                        <tr>
                                            <td>{{ $data_zonasi->firstItem() + $loop->index }}</td>
                                            <td>{{ $key_data_zonasi->nama_lengkap }}</td>
                                            <td>{{ $key_data_zonasi->no_pendaftaran }}</td>
                                            <td>{{ $key_data_zonasi->sekolah_asal }}</td>
                                            <td>
                                                {{-- {{ $key_data_zonasi->latitude_siswa }}, <br>
                                                {{ $key_data_zonasi->longitude_siswa }} <br> --}}
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ $key_data_zonasi->latitude_siswa }},{{ $key_data_zonasi->longitude_siswa }}"
                                                    target="_blank" class="btn btn-primary btn-xs"><i
                                                        class="fa fa-map-marker"></i> Lihat</a>
                                            </td>
                                            <td>{{ $key_data_zonasi->jarak }} meter</td>
                                            <td>{{ $key_data_zonasi->usia_kk }}</td>
                                            <td>
                                                <a href="{{ route('siswa.zonasi.cetak.index', ['id_siswa' => $key_data_zonasi->id_siswa]) }}"
                                                    target="_blank" class="btn btn-primary btn-xs"><i
                                                        class="fa fa-eye"></i> </a>
                                            </td>
                                            @if ($pengumuman_kelulusan->status_pengumuman != 'ditampilkan')
                                                <td>
                                                    <button
                                                        wire:click.prevent="dataId({{ $key_data_zonasi->id_pendaftaran }})"
                                                        type="button" data-bs-toggle="modal" data-original-title="test"
                                                        data-bs-target="#ModalVerifikasi"
                                                        class="btn btn-warning btn-xs"><i
                                                            class="fa fa-check-square"></i></button>
                                                    <button
                                                        wire:click.prevent="dataId({{ $key_data_zonasi->id_pendaftaran }})"
                                                        type="button" data-bs-toggle="modal" data-original-title="test"
                                                        data-bs-target="#ModalTolak" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-times"></i></button>
                                                    <a class="btn btn-info btn-xs"
                                                        href="{{ route('sekolah.revisi.zonasi.index', $key_data_zonasi->id_pendaftaran) }}"><i
                                                            class="fa fa-edit"></i></a>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11">
                                                <center>BELUM ADA DATA</center>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div wire:ignore.self class="modal fade" id="ModalVerifikasi" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Verifikasi</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Yakin ingin menyetujui data siswa ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="verifikasi()"
                                                class="btn btn-warning close-modal"
                                                data-dismiss="modal">Verifikasi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore.self class="modal fade" id="ModalTolak" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tolak Verifikasi</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Yakin ingin menolak data siswa ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="verifikasiDitolak()"
                                                class="btn btn-warning close-modal"
                                                data-dismiss="modal">Tolak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore.self class="modal fade" id="ModalPerbarui" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Perbarui Data Siswa</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3 needs-validation">
                                                <div class="col-md-6">
                                                    <label>Latitude</label>
                                                    <input type="text"
                                                        class="form-control @error('latitude_siswa') is-invalid @enderror"
                                                        placeholder="Contoh : -3.259305" autofocus
                                                        wire:model="latitude_siswa">
                                                    @error('latitude_siswa')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Longitude</label>
                                                    <input type="text"
                                                        class="form-control @error('longitude_siswa') is-invalid @enderror"
                                                        placeholder="Contoh : 104.6510159" autofocus
                                                        wire:model="longitude_siswa">
                                                    @error('longitude_siswa')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Jarak</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="otomatis by sistem" autofocus wire:model="jarak"
                                                        disabled>
                                                    <small>Jarak diatas menggunakan satuan meter</small>
                                                    @error('jarak')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- <div class="col-md-2">
                                                    <label>Ukur Jarak</label>
                                                    <button class="btn btn-primary" wire:click.prevent="cek_jarak({{ $key_data_zonasi->id_pendaftaran }})">Ukur Jarak</button>
                                                </div> --}}

                                                <div class="col-md-6">
                                                    <label>Usia Kartu Keluarga</label>
                                                    <input type="date"
                                                        class="form-control @error('usia_kk') is-invalid @enderror"
                                                        autofocus wire:model="usia_kk"
                                                        placeholder="Contoh : 2 Tahun, 7 Bulan">
                                                    @error('usia_kk')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label>File Kartu Keluarga</label>
                                                    <input type="file"
                                                        class="form-control @error('kartu_keluarga') is-invalid @enderror"
                                                        wire:model="kartu_keluarga">
                                                    <small> <a
                                                            href="{{ asset('storage/data_pendaftaran/' . $kartu_keluarga) }}"
                                                            target="_blank">
                                                            <i class="fa fa-eye"> Lihat kartu keluarga</i></a></small>
                                                    @error('kartu_keluarga')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Surat Keterangan BTA</label>
                                                    <input type="file"
                                                        class="form-control @error('sk_bta') is-invalid @enderror"
                                                        wire:model="sk_bta">
                                                    <small> <a
                                                            href="{{ asset('storage/data_pendaftaran/' . $kartu_keluarga) }}"
                                                            target="_blank">
                                                            <i class="fa fa-eye"> Lihat kartu surat keterangan
                                                                bta</i></a></small>
                                                    @error('sk_bta')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Surat Pengantar SD/MI</label>
                                                    <input type="file"
                                                        class="form-control @error('surat_pengantar_sd') is-invalid @enderror"
                                                        wire:model="surat_pengantar_sd">
                                                    <small> <a
                                                            href="{{ asset('storage/data_pendaftaran/' . $surat_pengantar_sd) }}"
                                                            target="_blank">
                                                            <i class="fa fa-eye"> Lihat surat pengantar</i></a></small>
                                                    @error('surat_pengantar_sd')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <div wire:loading wire:target="surat_pengantar_sd">Uploading...
                                                    </div>
                                                </div>
                                                {{-- @if ($persyaratan_sekolah)
                                                    @foreach ($persyaratan_sekolah as $item)
                                                        <div class="col-md-6">
                                                            <label>{{ $item }}</label>
                                                            <input type="file"
                                                                class="form-control @error('file') is-invalid @enderror"
                                                                wire:model="dynamicMapping.{{ $item }}">
                                                            <small> <a
                                                                    href="{{ asset('storage/data_pendaftaran/' . $item) }}"
                                                                    target="_blank">
                                                                    <i class="fa fa-eye"> Lihat
                                                                        {{ $item }}</i></a></small>
                                                            @error('file')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <div wire:loading wire:target="file">Uploading...
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif --}}
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="perbaruiData_proses()"
                                                class="btn btn-warning close-modal"
                                                data-dismiss="modal">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @if ($data_zonasi->hasPages())
                                <div class="d-flex justify-content-center">
                                    {{ $data_zonasi->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="lampiranModal" tabindex="-1" role="dialog"
        aria-labelledby="editExampleLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">File Persyaratan</h5>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        @php
                            $arr_pendaftaran = $file_persyaratan;
                            $potong_awal = substr($arr_pendaftaran, 2);
                            $potong_akhir = substr($potong_awal, 0, -2);
                            // @dd($potong_akhir);
                            $persyaratan_sekolah = explode('","', $potong_akhir);
                        @endphp
                        <table class="table table-striped">
                            <tr>
                                <th>File Persyaratan</th>
                                <th>Lihat</th>
                            </tr>
                            @foreach ($persyaratan_sekolah as $key => $value)
                                <tr>
                                    <td>
                                        <li>{{ $value }}</li>
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-xs"
                                            href="{{ asset('storage/data_pendaftaran/' . $value) }}"
                                            target="_blank">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
