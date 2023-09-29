<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Master Jadwal</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Master Jadwal</li>
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
                    <div class="card-header">
                        <button class="btn btn-pill btn-primary" type="button" data-bs-toggle="modal"
                            data-original-title="test" wire:click="resetInput()" data-bs-target="#TambahModal"> <i class="fa fa-plus"></i> Tambah
                            Data</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kegiatan</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($jadwal as $key_jadwal)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ strtoupper($key_jadwal->kegiatan) }}</td>
                                            <td>
                                                {{ $key_jadwal->tanggal }}
                                            </td>
                                            <td>
                                                {{ $key_jadwal->waktu }}
                                            </td>
                                            <td>
                                                <button class="btn btn-pill btn-warning btn-xs"
                                                    wire:click.prevent="dataId({{ $key_jadwal->id }})" type="button"
                                                    data-bs-toggle="modal" data-original-title="test"
                                                    data-bs-target="#EditModal"> <i class="fa fa-plus"></i>
                                                    Perbarui</button>
                                                <button class="btn btn-pill btn-danger btn-xs"
                                                    wire:click.prevent="dataId({{ $key_jadwal->id }})" type="button"
                                                    data-bs-toggle="modal" data-original-title="test"
                                                    data-bs-target="#DeleteModal"> <i
                                                    class="fa fa-trash"></i>
                                                    Hapus</button>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">
                                                <center>DATA TIDAK DITEMUKAN</center>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div wire:ignore.self class="modal fade" id="DeleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Data
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Yakin ingin menghapus Jadwal ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="delete()"
                                                class="btn btn-danger close-modal"
                                                data-dismiss="modal">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore.self class="modal fade" id="EditModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">KELOLA JADWAL</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="kontrol_jadwal">Tanggal Buka</label>
                                                <input wire:model="tanggal" type="text" class="form-control"
                                                    id="tanggal">
                                                @error('tanggal')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kontrol_jadwal">Tanggal Tutup</label>
                                                <input wire:model="waktu" type="text" class="form-control"
                                                    id="waktu">
                                                @error('waktu')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="update()"
                                                class="btn btn-warning close-modal"
                                                data-dismiss="modal">Perbarui</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore.self class="modal fade" id="TambahModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="pengumuman">Kegiatan</label>
                                                <input wire:model="kegiatan" placeholder="Ex: Pengumuman Online"
                                                    class="form-control" id="kegiatan">
                                                @error('kegiatan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="pengumuman">Tanggal</label>
                                                <input wire:model="tanggal" placeholder="Ex: 30 - 31 Juni"
                                                    class="form-control" id="tanggal">
                                                @error('tanggal')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="pengumuman">Waktu</label>
                                                <input wire:model="waktu" placeholder="Ex: 24 Jam"
                                                    class="form-control" id="waktu">
                                                @error('waktu')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="store()"
                                                class="btn btn-warning close-modal"
                                                data-dismiss="modal">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
