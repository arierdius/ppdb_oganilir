<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Master kontrol_jalur</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Kontrol Jalur</li>
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jalur</th>
                                        <th>Tanggal Buka</th>
                                        <th>Tanggal Tutup</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($kontrol_jalur as $key_jalur)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ strtoupper($key_jalur->jalur) }}</td>
                                            <td>
                                                {{ date('d M Y', strtotime($key_jalur->tanggal_buka)) }}
                                            </td>
                                            <td>
                                                {{ date('d M Y', strtotime($key_jalur->tanggal_tutup)) }}
                                            </td>
                                            <td>
                                                <button class="btn btn-pill btn-warning btn-xs"
                                                    wire:click.prevent="dataId({{ $key_jalur->id }})"
                                                    type="button" data-bs-toggle="modal" data-original-title="test"
                                                    data-bs-target="#EditModal"> <i class="fa fa-plus"></i> Kelola
                                                    Jalur</button>
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
                            <div wire:ignore.self class="modal fade" id="EditModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">KELOLA JALUR {{ strtoupper($jalur)}}</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="kontrol_jalur">Tanggal Buka</label>
                                                <input wire:model="tanggal_buka" type="date" class="form-control"
                                                    id="tanggal_buka">
                                                @error('tanggal_buka')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kontrol_jalur">Tanggal Tutup</label>
                                                <input wire:model="tanggal_tutup" type="date" class="form-control"
                                                    id="tanggal_tutup">
                                                @error('tanggal_tutup')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="update()"
                                                class="btn btn-danger close-modal" data-dismiss="modal">Perbarui</button>
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
