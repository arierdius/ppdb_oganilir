<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Jalur Prestasi</h3>
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
                            <div class="table-responsive">
                                <table class="table table" style="font-size: 12px;">
                                    <th style="background-color: gray">Nama File</th>
                                    <th style="background-color: gray">:</th>
                                    <th style="background-color: gray">Ubah File</th>
                                    <tr>
                                        <td>Surat Pengantar dari SD/MI - <b>pdf</b><br>
                                            <small>
                                                <a href="{{ asset('storage/data_pendaftaran/' . $surat_pengantar_sd) }}"
                                                    target="_blank">
                                                    <i class="fa fa-eye"> Lihat File</i>
                                                </a>
                                            </small>
                                        </td>
                                        <td>:</td>
                                        <td><input type="file"
                                                class="form-control @error('surat_pengantar_sd_baru') is-invalid @enderror"
                                                wire:model="surat_pengantar_sd_baru">
                                            @error('surat_pengantar_sd_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="surat_pengantar_sd_baru">Uploading...
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Suket Baca Tulis AlQuran (BTA) - <b>pdf</b><br>
                                            <small>
                                                <a href="{{ asset('storage/data_pendaftaran/' . $sk_bta) }}"
                                                    target="_blank">
                                                    <i class="fa fa-eye"> Lihat File</i>
                                                </a>
                                            </small>
                                        </td>
                                        <td>:</td>
                                        <td><input type="file"
                                                class="form-control @error('sk_bta_baru') is-invalid @enderror"
                                                wire:model="sk_bta_baru">
                                            @error('sk_bta_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="sk_bta_baru">Uploading...
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="background-color: gray"><b> AKADEMIK</b></td>
                                    </tr>
                                    <tr>
                                        <td>Scan Raport (wajib) - <b>pdf</b><br>
                                            <small>
                                                <a href="{{ asset('storage/data_pendaftaran/' . $raport) }}"
                                                    target="_blank">
                                                    <i class="fa fa-eye"> Lihat File</i>
                                                </a>
                                            </small>
                                        </td>
                                        <td>:</td>
                                        <td><input type="file"
                                                class="form-control @error('raport_baru') is-invalid @enderror"
                                                wire:model="raport_baru">
                                            @error('raport_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="raport_baru">Uploading...
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Scan Akumulasi Nilai Raport (wajib) - <b>pdf</b><br>
                                            <small>
                                                <a href="{{ asset('storage/data_pendaftaran/' . $akumulasi_raport) }}"
                                                    target="_blank">
                                                    <i class="fa fa-eye"> Lihat File</i>
                                                </a>
                                            </small>
                                        </td>
                                        <td>:</td>
                                        <td><input type="file"
                                                class="form-control @error('akumulasi_raport_baru') is-invalid @enderror"
                                                wire:model="akumulasi_raport_baru">
                                            @error('akumulasi_raport_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="akumulasi_raport_baru">Uploading...
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Scan Sertifikat Menang Lomba - <b>pdf</b><br>
                                            <small>
                                                <a href="{{ asset('storage/data_pendaftaran/' . $menang_lomba) }}"
                                                    target="_blank">
                                                    <i class="fa fa-eye"> Lihat File</i>
                                                </a>
                                            </small>
                                        </td>
                                        <td>:</td>
                                        <td><input type="file"
                                                class="form-control @error('menang_lomba_baru') is-invalid @enderror"
                                                wire:model="menang_lomba_baru">
                                            @error('menang_lomba_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="menang_lomba_baru">Uploading...
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="background-color: gray"><b> HAFIDZ QURAN</b></td>
                                    </tr>
                                    <tr>
                                        <td>Scan Surat Keterangan Dari Rumah Tahfidz - <b>pdf</b><br>
                                            <small>
                                                <a href="{{ asset('storage/data_pendaftaran/' . $suket_rumah_tahfidz) }}"
                                                    target="_blank">
                                                    <i class="fa fa-eye"> Lihat File</i>
                                                </a>
                                            </small>
                                        </td>
                                        <td>:</td>
                                        <td><input type="file"
                                                class="form-control @error('suket_rumah_tahfidz_baru') is-invalid @enderror"
                                                wire:model="suket_rumah_tahfidz_baru">
                                            @error('suket_rumah_tahfidz_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="suket_rumah_tahfidz_baru">Uploading...
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="background-color: gray"><b>NON AKADEMIK</b></td>
                                    </tr>
                                    <tr>
                                        <td>Scan Sertifikat Tingkat Kabupaten - <b>pdf</b><br>
                                            <small>
                                                <a href="{{ asset('storage/data_pendaftaran/' . $sertifikat_kabupaten) }}"
                                                    target="_blank">
                                                    <i class="fa fa-eye"> Lihat File</i>
                                                </a>
                                            </small>
                                        </td>
                                        <td>:</td>
                                        <td><input type="file"
                                                class="form-control @error('sertifikat_kabupaten_baru') is-invalid @enderror"
                                                wire:model="sertifikat_kabupaten_baru">
                                            @error('sertifikat_kabupaten_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="sertifikat_kabupaten_baru">Uploading...
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Scan Sertifikat Tingkat Provinsi - <b>pdf</b><br>
                                            <small>
                                                <a href="{{ asset('storage/data_pendaftaran/' . $sertifikat_provinsi) }}"
                                                    target="_blank">
                                                    <i class="fa fa-eye"> Lihat File</i>
                                                </a>
                                            </small>
                                        </td>
                                        <td>:</td>
                                        <td><input type="file"
                                                class="form-control @error('sertifikat_provinsi_baru') is-invalid @enderror"
                                                wire:model="sertifikat_provinsi_baru">
                                            @error('sertifikat_provinsi_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="sertifikat_provinsi_baru">Uploading...
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Scan Sertifikat Tingkat Nasional - <b>pdf</b><br>
                                            <small>
                                                <a href="{{ asset('storage/data_pendaftaran/' . $sertifikat_nasional) }}"
                                                    target="_blank">
                                                    <i class="fa fa-eye"> Lihat File</i>
                                                </a>
                                            </small>
                                        </td>
                                        <td>:</td>
                                        <td><input type="file"
                                                class="form-control @error('sertifikat_nasional_baru') is-invalid @enderror"
                                                wire:model="sertifikat_nasional_baru">
                                            @error('sertifikat_nasional_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="sk_bta_baru">Uploading...
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Scan Sertifikat Tingkat Internasional - <b>pdf</b><br>
                                            <small>
                                                <a href="{{ asset('storage/data_pendaftaran/' . $sertifikat_internasional) }}"
                                                    target="_blank">
                                                    <i class="fa fa-eye"> Lihat File</i>
                                                </a>
                                            </small>
                                        </td>
                                        <td>:</td>
                                        <td><input type="file"
                                                class="form-control @error('sertifikat_internasional_baru') is-invalid @enderror"
                                                wire:model="sertifikat_internasional_baru">
                                            @error('sertifikat_internasional_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div wire:loading wire:target="sertifikat_nasional_baru">Uploading...
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="modal-footer">
                                    <button type="button" wire:click.prevent="perbaruiData_proses()"
                                        class="btn btn-warning close-modal" data-dismiss="modal">Simpan</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


</div>
