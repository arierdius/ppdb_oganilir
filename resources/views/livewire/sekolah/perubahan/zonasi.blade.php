<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Jalur Zonasi</h3>
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
                            <div class="col-md-6">
                                <label>Latitude</label>
                                <input type="text" class="form-control @error('latitude_siswa') is-invalid @enderror"
                                    placeholder="Contoh : -3.259305" autofocus wire:model="latitude_siswa">
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
                                    placeholder="Contoh : 104.6510159" autofocus wire:model="longitude_siswa">
                                @error('longitude_siswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Jarak</label>
                                <input type="text" class="form-control" placeholder="otomatis by sistem" autofocus
                                    wire:model="jarak" disabled>
                                <small>Jarak diatas menggunakan satuan meter</small>
                                @error('jarak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label>Ukur Jarak</label>
                                <button class="btn btn-primary" wire:click.prevent="cek_jarak()">Ukur
                                    Jarak</button>
                            </div>

                            <div class="col-md-6">
                                <label>Usia Kartu Keluarga</label>
                                <input type="date" class="form-control @error('usia_kk') is-invalid @enderror"
                                    autofocus wire:model="usia_kk" placeholder="Contoh : 2 Tahun, 7 Bulan">
                                @error('usia_kk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>File Kartu Keluarga</label> <small>(PDF)</small>
                                <input type="file"
                                    class="form-control @error('kartu_keluarga_baru') is-invalid @enderror"
                                    wire:model="kartu_keluarga_baru">
                                <small>
                                    <a href="{{ asset('storage/data_pendaftaran/' . $file_kk) }}" target="_blank">
                                        <i class="fa fa-eye"> Lihat kartu keluarga</i></a></small>
                                @error('kartu_keluarga_baru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div wire:loading wire:target="sk_bta_baru">Uploading...
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Surat Keterangan BTA</label> <small>(PDF)</small>
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
                                <label>Surat Pengantar SD/MI</label> <small>(PDF)</small>
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
                                <div wire:loading wire:target="sk_bta_baru">Uploading...
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
