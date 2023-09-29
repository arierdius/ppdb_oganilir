<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Daftar Operator</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Operator</li>
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
                        <button wire:click.prevent="dataId({{ auth()->user()->sekolah_id }})" type="button"
                            data-bs-toggle="modal" data-original-title="test" data-bs-target="#ModalTambah"
                            class="btn btn-warning btn-xs"><i class="fa fa-plus"></i> Tambah Operator</button>
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
                                                <button wire:click.prevent="dataId({{ $key_users->id }})" type="button"
                                                    data-bs-toggle="modal" data-original-title="test"
                                                    data-bs-target="#ResetPassword" class="btn btn-danger btn-xs"><i
                                                        class="fa fa-allert"></i>
                                                    Reset Password</button>
                                            </td>
                                            <td>
                                                <button wire:click.prevent="dataId({{ $key_users->id }})" type="button"
                                                    data-bs-toggle="modal" data-original-title="test"
                                                    data-bs-target="#UbahPassword" class="btn btn-warning btn-xs"><i
                                                        class="fa fa-user"></i>
                                                    Ganti Password</button>
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
                            <div wire:ignore.self class="modal fade" id="ModalTambah" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Operator</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3 needs-validation" wire:submit.prevent="update">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>NIK</label>
                                                        <input type="number"
                                                            class="form-control @error('nik') is-invalid @enderror"
                                                            placeholder="Masukkan Nomor Induk Kependudukan" autofocus
                                                            wire:model="nik">
                                                        @error('nik')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama lengkap</label>
                                                        <input type="text"
                                                            class="form-control  @error('nama_lengkap') is-invalid @enderror"
                                                            placeholder="Masukkan Nama Lengkap" autofocus
                                                            wire:model="nama_lengkap">
                                                        @error('nama_lengkap')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text"
                                                            class="form-control @error('username') is-invalid @enderror"
                                                            placeholder="Masukkan Username" autofocus
                                                            wire:model="username">
                                                        @error('username')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <small>Username akan menjadi :
                                                            {{ $nama_sekolah_input }}_{{ $this->username }}</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="text"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            placeholder="Masukkan Password" autofocus
                                                            wire:model="password">
                                                        @error('password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="CreateUser()"
                                                class="btn btn-warning close-modal"
                                                data-dismiss="modal">Daftarkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div wire:ignore.self class="modal fade" id="ResetPassword" tabindex="-1" role="dialog"
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
                                            <p>Yakin ingin mereset password users ini?</p>
                                            <br>
                                            password default akan menjadi : {{ $nama_sekolah_input }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="update()"
                                                class="btn btn-warning close-modal"
                                                data-dismiss="modal">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div wire:ignore.self class="modal fade" id="UbahPassword" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xs" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Perbarui Password
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3 needs-validation">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Password Baru</label>
                                                        <input type="text"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            placeholder="Masukkan Password Baru" autofocus
                                                            wire:model="password">
                                                        @error('password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="perbaruipassword()"
                                                class="btn btn-warning close-modal"
                                                data-dismiss="modal">Perbarui</button>
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
