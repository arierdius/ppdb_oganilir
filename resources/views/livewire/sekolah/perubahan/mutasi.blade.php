<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Jalur Mutasi</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Perbarui Data Calon Siswa</li>
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
                                <table>
                                    <tr>
                                        <th style="width: 180px;">Nama</th>
                                        <th>{{ $nama_lengkap }}</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 180px;">No Pendaftaran</th>
                                        <th>{{ $nomor_pendaftaran }}</th>
                                    </tr>
                                </table>
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
                        <form class="row g-3 needs-validation">
                            <div class="col-md-4">
                                <label>Sk Mutasi Ortu</label>
                                <input type="file"
                                    class="form-control @error('sk_mutasi_orang_tua_baru') is-invalid @enderror"
                                    wire:model="sk_mutasi_orang_tua_baru">
                                <small>
                                    <a href="{{ asset('storage/data_pendaftaran/' . $sk_mutasi_orang_tua) }}"
                                        target="_blank">
                                        <i class="fa fa-eye"> Lihat sk mutasi</i></a></small>
                                @error('sk_mutasi_orang_tua_baru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div wire:loading wire:target="sk_mutasi_orang_tua_baru">Uploading...
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Surat Keterangan BTA</label>
                                <input type="file" class="form-control @error('sk_bta_baru') is-invalid @enderror"
                                    wire:model="sk_bta_baru">
                                <small>
                                    <a href="{{ asset('storage/data_pendaftaran/' . $sk_bta) }}" target="_blank">
                                        <i class="fa fa-eye"> Lihat kartu surat keterangan bta</i></a></small>
                                @error('sk_bta_baru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div wire:loading wire:target="sk_bta_baru">Uploading...
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Surat Pengantar SD/MI</label>
                                <input type="file"
                                    class="form-control @error('surat_pengantar_sd_baru') is-invalid @enderror"
                                    wire:model="surat_pengantar_sd_baru">
                                <small>
                                    <a href="{{ asset('storage/data_pendaftaran/' . $surat_pengantar_sd) }}"
                                        target="_blank">
                                        <i class="fa fa-eye"> Lihat surat pengantar</i></a></small>
                                @error('surat_pengantar_sd_baru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div wire:loading wire:target="surat_pengantar_sd_baru">Uploading...
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="perbaruiData_proses()"
                            class="btn btn-warning close-modal" data-dismiss="modal">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
