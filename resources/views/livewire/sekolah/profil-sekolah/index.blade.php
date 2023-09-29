<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Profil Sekolah</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Profil Sekolah</li>
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
                                    <label>Nama Sekolah</label>
                                    <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" placeholder="Masukkan Nama Sekolah"
                                        autofocus wire:model="nama_sekolah">
                                    @error('nama_sekolah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Npsn</label>
                                    <input type="text" class="form-control @error('npsn') is-invalid @enderror" placeholder="Masukkan Npsn" autofocus
                                        wire:model="npsn">
                                    @error('npsn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kepala Sekolah</label>
                                    <input type="text" class="form-control @error('kepala_sekolah') is-invalid @enderror"
                                        placeholder="Masukkan Nama Kepala Sekolah" autofocus
                                        wire:model="kepala_sekolah">
                                    @error('kepala_sekolah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" placeholder="Masukkan No Telepon"
                                        autofocus wire:model="telepon">
                                    @error('telepon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" placeholder="Masukkan Latitude" autofocus
                                        wire:model="latitude">
                                    @error('latitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" placeholder="Masukkan Longitude"
                                        autofocus wire:model="longitude">
                                    @error('longitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Faksimile</label>
                                    <input type="text" class="form-control @error('faksmili') is-invalid @enderror" placeholder="Masukkan faksimile" autofocus
                                        wire:model="faksmili">
                                    @error('faksmili')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Akreditasi</label>
                                    <input type="text" class="form-control @error('akreditasi') is-invalid @enderror" placeholder="Masukkan Akreditasi"
                                        autofocus wire:model="akreditasi">
                                    @error('akreditasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Surel</label>
                                    <input type="text" class="form-control @error('surel') is-invalid @enderror"
                                        placeholder="Masukkan Surat Elektronik / Email" autofocus wire:model="surel">
                                    @error('surel')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Situs Web</label>
                                    <input type="text" class="form-control @error('situs_web') is-invalid @enderror" placeholder="Masukkan Situs Web"
                                        autofocus wire:model="situs_web">
                                    @error('situs_web')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea cols="30" rows="5" class="form-control @error('alamat') is-invalid @enderror" wire:model="alamat"></textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror" autofocus wire:model="logo">
                                    @error('logo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}" alt="" width="100px">
                                    @elseif ($prev_photo)
                                        <img src="{{ asset('storage/data_sekolah/' . $prev_photo) }}" alt=""
                                            width="100px">
                                    @endif
                                </div>
                            </div>
                            <div wire:ignore class="col-md-12">
                                <div class="form-group">
                                    <label>Visi Misi</label>
                                    <textarea cols="30" rows="5" class="form-control @error('visi_misi') is-invalid @enderror" wire:model="visi_misi"></textarea>
                                    @error('visi_misi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 text-end">
                                <button type="button" class="btn btn-primary" wire:click="update">Simpan Profil</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
