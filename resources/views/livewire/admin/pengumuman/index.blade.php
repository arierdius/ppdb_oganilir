<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Master pengumuman</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Master Pengumuman</li>
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
                    <div class="card-header pb-0">
                        <button class="btn btn-pill btn-primary" type="button" data-bs-toggle="modal"
                            data-original-title="test" data-bs-target="#TambahModal"> <i class="fa fa-plus"></i> Tambah
                            Data</button>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <input class="form-control" placeholder="cari pengumuman" type="text"
                                    wire:model="search">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Pengumuman</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($pengumuman as $key_pengumuman)
                                        <tr>
                                            <td>{{ $pengumuman->firstItem() + $loop->index }}</td>
                                            <td>
                                                {{ date('d M Y', strtotime($key_pengumuman->created_at)) }}
                                            </td>
                                            <td>{{ $key_pengumuman->pengumuman }}</td>
                                            <td>
                                                @if ($key_pengumuman->status == 'aktif')
                                                    <span class="badge badge-warning">Aktif</span>
                                                @else
                                                    <span class="badge badge-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <th>
                                                {{-- 1 siswa
                                                2 sekolah
                                                3 tampil semua
                                                 --}}
                                                @if ($key_pengumuman->level == '1')
                                                    <span class="badge badge-info">Siswa</span>
                                                @elseif($key_pengumuman->level == '2')
                                                    <span class="badge badge-primary">Sekolah</span>
                                                @else
                                                    <span class="badge badge-warning">Semua</span>
                                                @endif
                                            </th>
                                            <td>
                                                @if ($key_pengumuman->status == 'aktif')
                                                    <button wire:click.prevent="dataId({{ $key_pengumuman->id }})"
                                                        type="button" data-bs-toggle="modal" data-original-title="test"
                                                        data-bs-target="#MatikanModal" class="btn btn-danger btn-xs"><i
                                                            class="fa fa-allert"></i>
                                                        Matikan</button>
                                                @else
                                                    <button wire:click.prevent="dataId({{ $key_pengumuman->id }})"
                                                        type="button" data-bs-toggle="modal" data-original-title="test"
                                                        data-bs-target="#AktifkanModal"
                                                        class="btn btn-warning btn-xs"><i class="fa fa-allert"></i>
                                                        Hidupkan</button>
                                                @endif

                                                <button wire:click.prevent="dataId({{ $key_pengumuman->id }})"
                                                    type="button" data-bs-toggle="modal" data-original-title="test"
                                                    data-bs-target="#DeleteModal" class="btn btn-danger btn-xs"><i
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
                                                <label for="pengumuman">Tampilkan Kepada</label>
                                                <select wire:model="level" class="form-control">
                                                    <option value="">Pilih Data</option>
                                                    <option value="1">Siswa</option>
                                                    <option value="2">Sekolah</option>
                                                    <option value="3">Semua</option>
                                                </select>
                                                @error('level')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="pengumuman">Pengumuman</label>
                                                <textarea wire:model="pengumuman_add" class="form-control" id="pengumuman_add" rows="3"></textarea>
                                                @error('pengumuman_add')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="store()"
                                                class="btn btn-warning close-modal" data-dismiss="modal">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <p>Yakin ingin menghapus Pengumuman ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="delete()"
                                                class="btn btn-danger close-modal"
                                                data-bs-dismiss="modal">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore.self class="modal fade" id="MatikanModal" tabindex="-1" role="dialog"
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
                                            <p>Yakin ingin mematikan Pengumuman ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="Matikan()"
                                                class="btn btn-danger close-modal"
                                                data-dismiss="modal">Matikan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore.self class="modal fade" id="AktifkanModal" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <p>Yakin ingin menghidupkan Pengumuman ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="Aktifkan()"
                                                class="btn btn-warning close-modal"
                                                datadismiss="modal">Hidupkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @if ($pengumuman->hasPages())
                                <div class="d-flex justify-content-center">
                                    {{ $pengumuman->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
