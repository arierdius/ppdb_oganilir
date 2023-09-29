<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Master users</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Master Users</li>
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
                        {{-- <button class="btn btn-pill btn-primary" type="button" wire:click.prevent="createUser()"> <i
                                class="fa fa-plus"></i> Tambah
                            Data</button>
                        <small>For Developer</small> --}}
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <input class="form-control" placeholder="cari users" type="text" wire:model="search">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Sekolah</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($users as $key_users)
                                        <tr>
                                            <td>{{ $users->firstItem() + $loop->index }}</td>
                                            <td>
                                                {{ $key_users->sekolah->nama_sekolah }}
                                            </td>
                                            <td>{{ $key_users->users_detail->nama_lengkap }}</td>
                                            <td>{{ $key_users->email }}</td>
                                            <td>
                                                <button wire:click.prevent="update({{ $key_users->id }})" type="button"
                                                    data-bs-toggle="modal" data-original-title="test"
                                                    data-bs-target="#KonfirmasiReset" class="btn btn-danger btn-xs"><i
                                                        class="fa fa-trash"></i>
                                                    Reset Password</button>
                                            </td>
                                            <td>
                                                <button wire:click.prevent="dataId({{ $key_users->id }})" type="button"
                                                    data-bs-toggle="modal" data-original-title="test"
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
                            {{-- <div wire:ignore.self class="modal fade" id="TambahModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah users</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="users">users</label>
                                                <textarea wire:model="users_add" class="form-control" id="users_add" rows="3"></textarea>
                                                @error('users_add')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="store()"
                                                class="btn btn-danger close-modal" data-dismiss="modal">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

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
                                            <p>Yakin ingin menghapus users ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="delete()"
                                                class="btn btn-warning close-modal" data-dismiss="modal">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore.self class="modal fade" id="KonfirmasiReset" tabindex="-1" role="dialog"
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
                                            <p>Yakin ingin mereset users ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="update()"
                                                class="btn btn-warning close-modal" data-dismiss="modal">Reset Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @if ($users->hasPages())
                                <div class="d-flex justify-content-center">
                                    {{ $users->links() }}
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
