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
                        <li class="breadcrumb-item">jalur-zonasi-verifikasi</li>
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
                                            <td>{{ $key_data_zonasi->latitude_siswa }}, <br>
                                                {{ $key_data_zonasi->longitude_siswa }}
                                            </td>
                                            <td>{{ $key_data_zonasi->jarak }}</td>
                                            <td>{{ $key_data_zonasi->usia_kk }}</td>
                                            <td><a href="{{ route('siswa.zonasi.cetak.index', ['id_siswa' => $key_data_zonasi->id_siswa]) }}"
                                                    target="_blank" class="btn btn-primary btn-xs"><i
                                                        class="fa fa-eye"></i> Detail</a></td>
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
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Yakin ingin Meloloskan data siswa ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="verifikasiDiterima()"
                                                class="btn btn-warning close-modal" data-dismiss="modal">Lulus</button>
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
                                            <button type="button" class="close" data-dismiss="modal"
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
                                                class="btn btn-warning close-modal" data-dismiss="modal">Tolak</button>
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

</div>
