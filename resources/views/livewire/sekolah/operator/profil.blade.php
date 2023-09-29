<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Profil Siswa</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">profil-siswa</li>
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
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" class="form-control @error('nik') @enderror" placeholder="Masukkan Nama Lengkap"
                                        autofocus wire:model="nik">
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama lengkap</label>
                                    <input type="text" class="form-control @error('nama_lengkap') @enderror" placeholder="Masukkan Nama Lengkap"
                                        autofocus wire:model="nama_lengkap">
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select wire:model="jenis_kelamin" class="form-control @error('jenis_kelamin') @enderror"
                                        aria-label="Default select example" id="jenis_kelamin">
                                        <option value="">Jenis Kelamin</option>
                                        <option value="laki-laki">Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                    @error('nama_fasilitas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control @error('tempat_lahir') @enderror" placeholder="Masukkan Tempat Lahir"
                                        autofocus wire:model="tempat_lahir">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tanggal_lahir') @enderror" placeholder="Masukkan Tanggal Lahir"
                                        autofocus wire:model="tanggal_lahir">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agama</label>
                                    <input type="text" class="form-control @error('agama') @enderror" placeholder="Masukkan Agama" autofocus
                                        wire:model="agama">
                                    @error('agama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nomor Telp/Wa</label>
                                    <input type="number" class="form-control @error('no_hp') @enderror" placeholder="Masukkan No Telp/Wa"
                                        autofocus wire:model="no_hp">
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control @error('alamat') @enderror" wire:model="alamat"></textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" class="form-control @error('foto') @enderror" placeholder="Masukkan Foto" autofocus
                                        wire:model="foto">
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                @if ($foto)
                                    <img src="{{ $foto->temporaryUrl() }}" alt="" width="100px">
                                @elseif ($prev_photo)
                                    <img src="{{ asset('storage/foto_siswa/' . $prev_photo) }}" alt=""
                                        width="100px">
                                @endif

                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" wire:click="update">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
