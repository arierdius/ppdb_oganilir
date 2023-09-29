<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Pendaftaran</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Jalur Prestasi</li>
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
                        @if ($pendaftaran->count() > 0)
                            {{-- @dd($pendaftaran[0]->jalur) --}}
                            @if ($status_pendaftaran == 'sudah')
                                <center><b>Perhatian !</b> Anda Sudah Mendaftar Jalur Prestasi</center> <br>
                                <center>
                                    <a href="{{ route('siswa.prestasi.cetak.index') }}" class="btn btn-primary">Lihat
                                        Resume Pendaftaran</a><br>
                                    <button class="btn mt-3" style="background-color: #DAAE2B;" type="button"
                                        data-bs-toggle="modal"
                                        data-original-title="test"wire:click.prevent="cetak({{ $pendaftaran[0]->id }})"
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove>Cetak Kartu Pendaftaran</span>
                                        <span wire:loading>Loading..</span>
                                </center>
                            @else
                                <center><b>Perhatian !</b> Anda Sudah Mendaftar Jalur
                                    <b>{{ strtoupper($pendaftaran[0]->jalur) }}</b>
                                </center>
                                <center>
                                    <p>Anda tidak bisa mendaftar lebih dari satu jalur yang dibuka secara bersamaan !!
                                    </p>
                                </center>
                            @endif
                        @else
                            @if ($kontrol_jalur->count() < 1)
                                <center><b>Perhatian !</b></center>
                                <center>
                                    <p>Pendaftaran Online dibuka tanggal
                                        {{ date('d', strtotime($tanggal_buka->tanggal_buka)) }} -
                                        {{ date('d F Y', strtotime($tanggal_buka->tanggal_tutup)) }}</p>
                                </center>
                            @else
                                <form class="row g-3 needs-validation">
                                    <div class="col-md-12">
                                        <label class="col-form-label">Pilih Sekolah</label>
                                        <select wire:model="id_sekolah" required=""
                                            class="js-example-basic-single col-sm-12 @error('id_sekolah') is-invalid @enderror"
                                            id="id_sekolah">
                                            <option value="">--Pilih Sekolah--</option>
                                            @foreach ($daftar_sekolah as $key_sekolah)
                                                <option value="{{ $key_sekolah->id }}">
                                                    {{ $key_sekolah->nama_sekolah }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_sekolah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    @if ($agama_user == 'islam')
                                        <div class="col-md-6">
                                        @else
                                            <div class="col-md-12">
                                    @endif
                                    <label>Surat Pengantar dari SD/MI (wajib)</label>
                                    <input type="file"
                                        class="form-control @error('surat_pengantar_sd') is-invalid @enderror"
                                        wire:model="surat_pengantar_sd">
                                    <small>Format : pdf</small>
                                    @error('surat_pengantar_sd')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div wire:loading wire:target="surat_pengantar_sd">Uploading...</div>
                    </div>

                    @if ($agama_user == 'islam')
                        <div class="col-md-6">
                            <label>Suket Baca Tulis AlQuran (BTA)</label>
                            <input type="file" class="form-control @error('sk_bta') is-invalid @enderror"
                                wire:model="sk_bta">
                            <small>Format : pdf</small>
                            @error('sk_bta')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div wire:loading wire:target="sk_bta">Uploading...</div>
                        </div>
                    @endif

                    <div class="col-md-12 mt-5">
                        <b>AKADEMIK</b>
                    </div>

                    <div class="col-md-4">
                        <label>Scan Raport (wajib)</label>
                        <input type="file" class="form-control @error('raport') is-invalid @enderror"
                            wire:model="raport">
                        <small>Format : pdf</small>
                        @error('raport')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div wire:loading wire:target="raport">Uploading...</div>
                        <small>Raport Semester 7 S.D 11</small>
                    </div>

                    <div class="col-md-4">
                        <label>Scan Akumulasi Nilai Raport (wajib)</label>
                        <input type="file" class="form-control @error('akumulasi_raport') is-invalid @enderror"
                            wire:model="akumulasi_raport">
                        <small>Format : pdf</small>
                        @error('akumulasi_raport')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div wire:loading wire:target="akumulasi_raport">Uploading...</div>
                    </div>

                    <div class="col-md-4">
                        <label>Scan Sertifikat Menang Lomba</label>
                        <input type="file" class="form-control" wire:model="menang_lomba">
                        <small>Format : pdf</small><br>
                        @error('menang_lomba')
                            <div class="invalid-feedback d-none">
                                {{ $message }}
                            </div>
                        @enderror
                        <div wire:loading wire:target="menang_lomba">Uploading...</div>
                        <small>Tingkat Kabupaten,Provinsi,Nasional, dan Internasional (Jika Ada)</small>
                    </div>


                    <div class="col-md-12 mt-5">
                        <b>HAFIDZ QURAN</b>
                    </div>
                    <div class="col-md-12">
                        <label>Scan Surat Keterangan Dari Rumah Tahfidz</label>
                        <input type="file" class="form-control" wire:model="suket_rumah_tahfidz">
                        @error('suket_rumah_tahfidz')
                            <div class="invalid-feedback d-none">
                                {{ $message }}
                            </div>
                        @enderror
                        <small>Format : pdf</small><br>
                        @error('suket_rumah_tahfidz')
                            <div class="invalid-feedback d-none">
                                {{ $message }}
                            </div>
                        @enderror
                        <div wire:loading wire:target="suket_rumah_tahfidz">Uploading...</div>
                        <small>Tingkat Kabupaten,Provinsi,Nasional, dan Internasional (Jika Ada)</small>
                    </div>

                    <div class="col-md-12 mt-5">
                        <b>NON AKADEMIK</b>
                    </div>

                    <div class="col-md-6">
                        <label>Scan Sertifikat Tingkat Kabupaten</label>
                        <input type="file" class="form-control" wire:model="sertifikat_kabupaten">
                        <small>Format : pdf</small><br>
                        @error('sertifikat_kabupaten')
                            <div class="invalid-feedback d-none">
                                {{ $message }}
                            </div>
                        @enderror
                        <div wire:loading wire:target="sertifikat_kabupaten">Uploading...</div>
                    </div>

                    <div class="col-md-6">
                        <label>Scan Sertifikat Tingkat Provinsi</label>
                        <input type="file" class="form-control" wire:model="sertifikat_provinsi">
                        <small>Format : pdf</small><br>
                        @error('sertifikat_provinsi')
                            <div class="invalid-feedback d-none">
                                {{ $message }}
                            </div>
                        @enderror
                        <div wire:loading wire:target="sertifikat_provinsi">Uploading...</div>
                    </div>
                    <div class="col-md-6">
                        <label>Scan Sertifikat Tingkat Nasional</label>
                        <input type="file" class="form-control" wire:model="sertifikat_nasional">
                        <small>Format : pdf</small><br>
                        @error('sertifikat_nasional')
                            <div class="invalid-feedback d-none">
                                {{ $message }}
                            </div>
                        @enderror
                        <div wire:loading wire:target="sertifikat_nasional">Uploading...</div>
                    </div>

                    <div class="col-md-6">
                        <label>Scan Sertifikat Tingkat Internasional</label>
                        <input type="file" class="form-control" wire:model="sertifikat_internasional">
                        <small>Format : pdf</small><br>
                        @error('sertifikat_internasional')
                            <div class="invalid-feedback d-none">
                                {{ $message }}
                            </div>
                        @enderror
                        <div wire:loading wire:target="sertifikat_internasional">Uploading...</div>
                    </div>

                    @if ($persyaratan->count() > 0)
                        <hr>
                        <label for="">PERSYARATAN WAJIB <b
                                style="color: black;">{{ $pesan_persyaratan }}</b></label>
                        @foreach ($persyaratan as $key_persyaratan)
                            @php
                                $nama_surat = $key_persyaratan->nama_surat;
                                $new_nama_surat = strtr($nama_surat, '_', ' ');

                            @endphp
                            <div class="col-md-4">
                                <label>{{ ucwords($new_nama_surat) }} (wajib)</label>
                                <input type="file" wire:model="dynamicMapping.{{ $nama_surat }}"
                                    class="form-control" placeholder="Masukkan Foto">
                            </div>
                        @endforeach
                    @endif
                    <div class="col-md-12 mb-2">
                        <input type="checkbox" wire:model="sdk"> <i>saya menyatakan dengan sesungguhnya bahwa data dan
                            dokumen yang saya input ke dalam aplikasi PPDB
                            ini adalah benar. Apabila di kemudian hari diketahui bahwa data dan dokumen ini tidak benar,
                            maka saya siap bertanggung jawab untuk menerima konsekuensi sesuai dengan
                            peraturan yang berlaku</i></p>
                        {{-- <button type="button" class="btn btn-primary" wire:click="store">Daftar</button> --}}
                        {{-- <button class="btn btn-primary" wire:click.prevent="store"
                                                    wire:loading.attr="disabled">
                                                    <span wire:loading.remove>Daftar</span>
                                                    <span wire:loading>Proses Upload..</span>
                                                </button> --}}
                    </div>
                    <div class="col-md-12">
                        @if ($sdk != null)
                            <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                data-original-title="test" data-bs-target="#exampleModal"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>Daftar</span>
                                <span wire:loading>Proses Upload..</span>
                            @else
                                <button class="btn btn-success" disabled>Daftar</button>
                        @endif
                    </div>
                    </form>
                    @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" wire:ignore.self id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Informasi</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Periksa kembali data anda sebelum mengirim formulir, data yang sudah terkirim tidak dapat
                    diperbarui !</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">batal</button>
                <button class="btn btn-success" type="button" wire:click.prevent="store"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>Daftar</span>
                    <span wire:loading>Proses Upload..</span>
            </div>
        </div>
    </div>
</div>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#id_sekolah').select2().on('change', function(e) {
                @this.set('id_sekolah', e.target.value);
            });

            window.livewire.on('reinitializeSelect2', () => {
                $('#id_sekolah').select2().on('change', function(e) {
                    @this.set('id_sekolah', e.target.value);
                });
            });
        });
    </script>
@endpush
