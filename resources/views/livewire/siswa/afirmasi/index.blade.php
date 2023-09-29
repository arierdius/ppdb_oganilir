<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Pendaftaran</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Jalur Afirmasi</li>
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
                        {{-- // jika sudah mendaftar maka --}}
                        @if ($pendaftaran->count() > 0)
                            {{-- @dd($pendaftaran[0]->jalur) --}}
                            @if ($status_pendaftaran == 'sudah')
                                <center>
                                    <a href="{{ route('siswa.afirmasi.cetak.index') }}" class="btn btn-primary">Lihat
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
                                <center><b>Perhatian !</b> Jaluar Afirmasi belum Dibuka</center>
                                <center>
                                    <p>Pendaftaran Online dibuka tanggal
                                        {{ date('d', strtotime($tanggal_buka->tanggal_buka)) }} -
                                        {{ date('d F Y', strtotime($tanggal_buka->tanggal_tutup)) }}</p>
                                </center>
                            @else
                                <form class="row g-3 needs-validation">
                                    <div class="col-md-12">
                                        <label class="col-form-label">Pilih Sekolah</label>
                                        <select wire:model="id_sekolah"
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
                                        <div class="col-md-4">
                                        @else
                                            <div class="col-md-6">
                                    @endif
                                    <label>Surat Pengantar SD/MI</label>
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
                        <div class="col-md-4">
                        @else
                            <div class="col-md-6">
                    @endif
                    <label>File PKH / KIP</label>
                    <input type="file" class="form-control @error('pkh_kip') is-invalid @enderror"
                        wire:model="pkh_kip">
                    <small>Format : pdf</small>
                    @error('pkh_kip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div wire:loading wire:target="pkh_kip">Uploading...</div>
                </div>
                @if ($agama_user == 'islam')
                    <div class="col-md-4">
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

                @if ($persyaratan->count() > 0)
                    <hr>
                    <label for="">PERSYARATAN WAJIB <b style="color: black;">{{ $pesan_persyaratan }}</b>
                    </label>
                    @foreach ($persyaratan as $key_persyaratan)
                        @php
                            $nama_surat = $key_persyaratan->nama_surat;
                            $new_nama_surat = strtr($nama_surat, '_', ' ');

                        @endphp
                        <div class="col-md-4">
                            <label>{{ ucwords($new_nama_surat) }}</label>
                            <input type="file" wire:model="dynamicMapping.{{ $nama_surat }}" class="form-control"
                                placeholder="Masukkan Foto">
                        </div>

                        <div wire:loading wire:target="dynamicMapping.{{ $nama_surat }}">Uploading...
                        </div>
                    @endforeach
                @endif

                <div class="col-md-12 mb-2">
                    <input type="checkbox" wire:model="sdk"> <i>saya menyatakan dengan sesungguhnya bahwa data dan
                        dokumen yang saya input ke dalam aplikasi PPDB
                        ini adalah benar. Apabila di kemudian hari diketahui bahwa data dan dokumen ini tidak benar,
                        maka saya siap bertanggung jawab untuk menerima konsekuensi sesuai dengan
                        peraturan yang berlaku</i></p>
                </div>
                <div class="col-md-12">
                    @if ($sdk != null)
                        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-original-title="test"
                            data-bs-target="#exampleModal" wire:loading.attr="disabled">
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
                <button class="btn btn-success" type="button" wire:click.prevent="store" wire:loading.attr="disabled">
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
