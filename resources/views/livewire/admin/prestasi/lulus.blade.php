@php
    $pengumuman_kelulusan = App\Models\Admin\PengumumanKelulusan::first();
@endphp
<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Jalur Prestasi</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">jalur-prestasi-lulus</li>
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
                                Jumlah Minimal Penerimaan (30% dari {{ $daya_tampung->daya_tampung }}) :
                                {{ ($daya_tampung->daya_tampung * 30) / 100 }} Siswa <br>
                                Jumlah Diterima : @php
                                    echo count($data_prestasi) . ' Siswa';
                                @endphp
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
                                        {{-- <th>Total Nilai Non Akademik</th> --}}
                                        <th>Detail</th>
                                        @if ($pengumuman_kelulusan->status_pengumuman != 'ditampilkan')
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($data_prestasi as $key_data_prestasi)
                                        {{-- @dd($key_data_prestasi) --}}
                                        <tr>
                                            <td>{{ $data_prestasi->firstItem() + $loop->index }}</td>
                                            <td>{{ $key_data_prestasi->nama_lengkap }}</td>
                                            <td>{{ $key_data_prestasi->no_pendaftaran }}</td>
                                            <td>{{ $key_data_prestasi->sekolah_asal }}</td>
                                            {{-- <td>{{ $key_data_prestasi->prestasi->total_nilai_akademik }}</td> --}}
                                            {{-- <td><button style="background-color:#46ACFA;text"
                                                    class="btn btn-xs">{{ ucfirst($key_data_prestasi->status) }}</button>
                                            </td> --}}
                                            {{-- <td>{{ $key_data_prestasi->data_prestasi[0]->no_data_prestasian }}</td> --}}

                                            <td>
                                                <a href="{{ route('siswa.prestasi.cetak.index', ['id_siswa' => $key_data_prestasi->id_siswa]) }}"
                                                    target="_blank" class="btn btn-primary btn-xs"><i
                                                        class="fa fa-eye"></i> Detail</a>
                                            </td>
                                            @if ($pengumuman_kelulusan->status_pengumuman != 'ditampilkan')
                                                <td>
                                                    <button wire:click.prevent="dataId({{ $key_data_prestasi->id }})"
                                                        type="button" data-bs-toggle="modal" data-original-title="test"
                                                        data-bs-target="#exampleModal" class="btn btn-primary btn-xs"><i
                                                            class="fa fa-repeat"></i> Pindahkan</button>
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
                            <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Data</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="jenis_verifikasi">Kembalikan Data</label>
                                                <select wire:model="jenis_verifikasi" class="form-control">
                                                    <option value="">--Pilih Data--</option>
                                                    <option value="menunggu">Pendaftar</option>
                                                    <option value="diverifikasi">Lolos Verifikasi</option>
                                                </select>
                                                @error('jenis_verifikasi')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="returnVerifikasi()"
                                                class="btn btn-danger close-modal"
                                                data-dismiss="modal">Pindahkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @if ($data_prestasi->hasPages())
                                <div class="d-flex justify-content-center">
                                    {{ $data_prestasi->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
