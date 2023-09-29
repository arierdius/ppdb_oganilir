<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Edit Data Sekolah</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" wire:model="nama_sekolah" class="form-control" id="nama_sekolah"
                                placeholder="Nama Sekolah">
                            @error('nama_sekolah')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" wire:model="alamat" class="form-control" id="alamat"
                                placeholder="Alamat">
                            @error('alamat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div wire:ignore class="form-group">
                            <label for="kecamatan_id">Kecamatan</label>
                            <select wire:model="kecamatan_id" class="js-example-basic-single col-sm-12"
                                id="kecamatan_id">
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatan as $key_kecamatan)
                                    <option value="{{ $key_kecamatan->id }}">{{ $key_kecamatan->nama_kecamatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kecamatan_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" wire:model="telepon" class="form-control" id="telepon"
                                placeholder="Telepon">
                            @error('telepon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kepala_sekolah">Kepala Sekolah</label>
                            <input type="text" wire:model="kepala_sekolah" class="form-control" id="kepala_sekolah"
                                placeholder="Kepala Sekolah">
                            @error('kepala_sekolah')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="situs_web">Situs Web</label>
                            <input type="text" wire:model="situs_web" class="form-control" id="situs_web"
                                placeholder="Situs Web">
                            @error('situs_web')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-footer">
                            <button wire:click.prevent="update" type="button"
                                class="btn btn-primary btn-block">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#kecamatan_id').select2().on('change', function(e) {
                @this.set('kecamatan_id', e.target.value);
            });
        });
    </script>
    
@endpush
