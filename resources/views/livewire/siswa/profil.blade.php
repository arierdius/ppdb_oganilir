<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Profil Calon Siswa</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Profil Calon Siswa</li>
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
                        <form class="row g-3 needs-validation"wire:submit.prevent="update">
                            <div class="col-md-6">
                                <label>NIK</label>
                                <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                    placeholder="Masukkan Nomor Induk KTP" autofocus wire:model="nik">
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Nama lengkap</label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    placeholder="Masukkan Nama Lengkap" autofocus wire:model="nama_lengkap">
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @if ($tambah_sekolah == true)
                                <div class="row">

                                    <div class="col-md-10">
                                        <label class="col-form-label">Sekolah Asal</label>
                                        <button class="btn btn-pill btn-primary btn-xs" type="button"
                                            wire:click="pilih_sekolah">
                                            <i class="fa fa-check"></i>
                                            Pilih Sekolah</button>
                                        <input type="text"
                                            class="form-control @error('sekolah_baru') is-invalid @enderror"
                                            placeholder="Masukkan Nama Lengkap" autofocus wire:model="sekolah_baru">
                                        @error('sekolah_baru')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <div style="margin-top: 44px;">
                                            <a href="#" wire:click="save_sekolah" class="btn btn-primary">
                                                <span class="fa fa-eye fa-xs"></span>
                                                Save</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <label class="col-form-label">Sekolah Asal</label>
                                    <button class="btn btn-pill btn-primary btn-xs" type="button"
                                        wire:click="tambah_sekolah">
                                        <i class="fa fa-plus"></i>
                                        Tambah Sekolah</button>
                                    <select wire:model="sekolah_id"
                                        class="js-example-basic-single col-sm-12 @error('sekolah_id') is-invalid @enderror"
                                        id="sekolah_id">
                                        <option value="">--Pilih Sekolah--</option>
                                        @foreach ($sekolah as $key_sekolah)
                                            <option value="{{ $key_sekolah->id }}">
                                                {{ $key_sekolah->nama_sekolah }}</option>
                                        @endforeach
                                    </select>
                                    @error('sekolah_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endif



                            <div class="col-md-12">
                                <label>Metode pengambilan Latitude dan Longitude</label>
                                <select wire:model.prevent="metode_lokasi"
                                    class="form-control @error('metode_lokasi') is-invalid @enderror"
                                    aria-label="Default select example" id="metode_lokasi">
                                    <option value="">--Pilih Jenis--</option>
                                    <option value="aplikasi">Aplikasi</option>
                                    <option value="manual">Manual</option>
                                </select>
                                @error('metode_lokasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            @if ($metode_lokasi == 'manual')
                                <div class="col-md-4">
                                    <label>Latitude</label>
                                    <input type="text"
                                        class="form-control @error('latitude_siswa') is-invalid @enderror"
                                        placeholder="Contoh : -3.259305" autofocus wire:model="latitude_siswa">
                                    @error('latitude_siswa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
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
                                @if ($generate_lokasi != null)
                                    <div class="col-md-4">
                                        <label>Foto Rumah</label> <small>(Format Gambar dan Maksimal 1mb )</small>
                                        <input type="file"
                                            class="form-control @error('foto_rumah') is-invalid @enderror"
                                            placeholder="Masukkan Foto" autofocus wire:model="foto_rumah">
                                        @error('foto_rumah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small>
                                            <a href="{{ asset('/storage/pendukung_koordinat/' . $file_lokasi) }}"
                                                target="_blank">
                                                <span class="fa fa-eye fa-xs"></span>
                                                Lihat File</a>
                                        </small>
                                    </div>
                                @else
                                    <div class="col-md-4">
                                        <label>Foto Rumah</label> <small>( Maksimal 1mb )</small>
                                        <input type="file"
                                            class="form-control @error('foto_rumah') is-invalid @enderror"
                                            placeholder="Masukkan Foto" autofocus wire:model="foto_rumah">
                                        @error('foto_rumah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        Format : JPG
                                    </div>
                                @endif
                            @else
                                <div class="col-md-4">
                                    <label>Latitude</label>
                                    <input type="text"
                                        class="form-control @error('latitude_siswa') is-invalid @enderror"
                                        placeholder="Contoh : -3.259305" disabled autofocus wire:model="latitude_siswa">
                                    @error('latitude_siswa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Longitude</label>
                                    <input type="text"
                                        class="form-control @error('longitude_siswa') is-invalid @enderror"
                                        placeholder="Contoh : 104.6510159" disabled autofocus
                                        wire:model="longitude_siswa">
                                    @error('longitude_siswa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                @if ($generate_lokasi == '1')
                                    <div class="col-md-2">
                                        <label>Google Maps</label><br>
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ $latitude_siswa }},{{ $longitude_siswa }}"
                                            target="_blank" class="btn btn-primary">
                                            <span class="fa fa-eye fa-xs"></span>
                                            Lihat Lokasi</a>
                                    </div>
                                    <div class="col-md-2">
                                        <label>File Lokasi Anda</label><br>
                                        <a href="{{ asset('/storage/pendukung_koordinat/' . $file_lokasi) }}"
                                            target="_blank" class="btn btn-primary">
                                            <span class="fa fa-eye fa-xs"></span>
                                            Lihat File</a>
                                    </div>
                                @else
                                    <div class="col-md-4">
                                        <label>Cara Mengisi Lokasi</label><br>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#myModal">
                                            <span class="fa fa-eye fa-xs"></span>
                                            Lihat Cara Pengisian Lokasi</button>
                                    </div>
                                @endif
                            @endif



                            <div class="col-md-6">
                                <label>Jenis Kelamin</label>
                                <select wire:model="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                    aria-label="Default select example" id="jenis_kelamin">
                                    <option value="">Jenis Kelamin</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Tempat Lahir</label>
                                <input type="text"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    placeholder="Masukkan Tempat Lahir" autofocus wire:model="tempat_lahir">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Tanggal Lahir</label>
                                <input type="date"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    placeholder="Masukkan Tanggal Lahir" autofocus wire:model="tanggal_lahir">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Agama</label>
                                <select wire:model="agama" class="form-control @error('agama') is-invalid @enderror"
                                    aria-label="Default select example" id="agama">
                                    <option value="">Pilih Agama</option>
                                    <option value="islam">Islam</option>
                                    <option value="protestan">Protestan</option>
                                    <option value="katolik">Katolik</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="buddha">Buddha</option>
                                    <option value="khonghucu">Khonghucu</option>
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Nomor Telp/Wa</label>
                                <input type="number" class="form-control @error('no_hp') is-invalid @enderror"
                                    placeholder="Masukkan No Telp/Wa" autofocus wire:model="no_hp">
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Foto</label> <small>( Maksimal 1mb )</small>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    placeholder="Masukkan Foto" autofocus wire:model="foto">
                                @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if ($foto)
                                    <img src="{{ $foto->temporaryUrl() }}" alt="" width="100px">
                                @elseif ($prev_photo)
                                    <img src="{{ asset('storage/foto_siswa/' . $prev_photo) }}" alt=""
                                        width="100px">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label>Provinsi</label>
                                <select wire:model="provinsi_id"
                                    class="js-example-basic-single col-sm-12 @error('provinsi_id') is-invalid @enderror"
                                    aria-label="Default select example" id="provinsi_id">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($arrprovinsi as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_provinsi }}</option>
                                    @endforeach
                                </select>
                                @error('provinsi_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Kabupaten/Kota</label>
                                <select wire:model="kabupaten_id"
                                    class="js-example-basic-single col-sm-12 @error('kabupaten_id') is-invalid @enderror"
                                    aria-label="Default select example" id="kabupaten_id">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    @foreach ($arrkabupaten as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kabupaten }}</option>
                                    @endforeach
                                </select>
                                @error('kabupaten_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Kecamatan</label>
                                <select wire:model="kecamatan_id"
                                    class="js-example-basic-single col-sm-12 @error('kecamatan_id') is-invalid @enderror"
                                    aria-label="Default select example" id="kecamatan_id">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($arrkecamatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                                @error('kecamatan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Kelurahan</label>
                                <select wire:model="kelurahan_id"
                                    class="js-example-basic-single col-sm-12 @error('kelurahan_id') is-invalid @enderror"
                                    aria-label="Default select example" id="kelurahan_id">
                                    <option value="">Pilih Kelurahan</option>
                                    @foreach ($arrkelurahan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kelurahan }}</option>
                                    @endforeach
                                </select>
                                @error('kelurahan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>RT</label>
                                <input type="number" class="form-control @error('rt') is-invalid @enderror"
                                    placeholder="Masukkan RT" autofocus wire:model="rt">
                                @error('rt')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>RW</label>
                                <input type="number" class="form-control @error('rw') is-invalid @enderror"
                                    placeholder="Masukkan RW" autofocus wire:model="rw">
                                @error('rw')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Kode Pos</label>
                                <input type="number" class="form-control @error('kode_pos') is-invalid @enderror"
                                    placeholder="Masukkan Kode Pos" autofocus wire:model="kode_pos">
                                @error('kode_pos')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label>Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="5"
                                    class="form-control @error('alamat') is-invalid @enderror" wire:model="alamat"></textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                @if ($metode_lokasi == 'aplikasi')
                                    {{-- @if ($generate_lokasi == null)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#myModal">
                                            <span class="fa fa-eye fa-xs"></span>
                                            Simpan Wajib Isi</button>
                                    @else --}}
                                        <button type="button" class="btn btn-primary" wire:click="update">Simpan</button>
                                    {{-- @endif --}}
                                @elseif($metode_lokasi == 'manual')
                                    <button type="button" class="btn btn-primary" wire:click="update">Simpan</button>

                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Panduan Pengisian Profil
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Panduan pengisian titik koordinat bisa <b><a
                                href="https://drive.google.com/file/d/1Qo-FUIvFxfNKWXJfI8D8V9HvhErBNthE/view?usp=sharing"
                                target="_blank"><u>Lihat disini!!</u></a></b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Tutup</button>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#sekolah_id').select2().on('change', function(e) {
                @this.set('sekolah_id', e.target.value);
            });

            window.livewire.on('reinitializeSelect2', () => {
                $('#sekolah_id').select2().on('change', function(e) {
                    @this.set('sekolah_id', e.target.value);
                });
            });

            $('#provinsi_id').select2().on('change', function(e) {
                @this.set('provinsi_id', e.target.value);
            });

            window.livewire.on('reinitializeSelect2', () => {
                $('#provinsi_id').select2().on('change', function(e) {
                    @this.set('provinsi_id', e.target.value);
                });
            });

            $('#kabupaten_id').select2().on('change', function(e) {
                @this.set('kabupaten_id', e.target.value);
            });

            window.livewire.on('reinitializeSelect2', () => {
                $('#kabupaten_id').select2().on('change', function(e) {
                    @this.set('kabupaten_id', e.target.value);
                });
            });

            $('#kecamatan_id').select2().on('change', function(e) {
                @this.set('kecamatan_id', e.target.value);
            });

            window.livewire.on('reinitializeSelect2', () => {
                $('#kecamatan_id').select2().on('change', function(e) {
                    @this.set('kecamatan_id', e.target.value);
                });
            });

            $('#kelurahan_id').select2().on('change', function(e) {
                @this.set('kelurahan_id', e.target.value);
            });

            window.livewire.on('reinitializeSelect2', () => {
                $('#kelurahan_id').select2().on('change', function(e) {
                    @this.set('kelurahan_id', e.target.value);
                });
            });

        });
    </script>
@endpush
