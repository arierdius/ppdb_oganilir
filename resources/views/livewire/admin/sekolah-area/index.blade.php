<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Area Kelurahan Sekolah</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">master-area-kelurahan-sekolah</li>
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
                            data-original-title="test" data-bs-target="#TambahModal"> <i class="fa fa-plus"></i>
                            Tambah
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
                                        <th>Nama Kelurahan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data_sekolah as $key_area)
                                        <tr>
                                            {{-- <td>{{ $data_sekolah->firstItem() + $loop->index }}</td> --}}
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $key_area->kelurahan->nama_kelurahan }}</td>
                                            <td>
                                                <button wire:click.prevent="dataId({{ $key_area->id }})" type="button"
                                                    data-bs-toggle="modal" data-original-title="test"
                                                    data-bs-target="#DeleteModal" class="btn btn-danger btn-xs"><i
                                                        class="fa fa-trash"></i>
                                                    Hapus</button>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">
                                                <center>Pilih Sekolah Terlebih Dahulu</center>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- TAMBAH KELURAHAN --}}
                            {{-- @dd($data_kelurahan) --}}
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
                                            <div wire:ignore class="form-group">
                                                <label for="pengumuman">Pengumuman</label>
                                                <select wire:model="id_kelurahan"
                                                    class="js-example-basic-multiple col-sm-12" multiple="multiple"
                                                    id="arrKelurahan">
                                                    <option value="">Pilih Kelurahan</option>
                                                    @foreach ($data_kelurahan as $key_kelurahan)
                                                        <option value="{{ $key_kelurahan->id }}">
                                                            {{ $key_kelurahan->nama_kelurahan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary close-btn"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="button" wire:click.prevent="store()"
                                                    class="btn btn-danger close-modal"
                                                    data-dismiss="modal">Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- TAMBAH KELURAHAN --}}

                            <div wire:ignore.self class="modal fade" id="DeleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Data</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Yakin ingin menghapus data kelurahan ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn"
                                                data-dismiss="modal">Batal</button>
                                            <button type="button" wire:click.prevent="delete()"
                                                class="btn btn-danger close-modal" data-dismiss="modal">Matikan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            {{-- @if ($data_sekolah->hasPages())
                                <div class="d-flex justify-content-center">
                                    {{ $data_sekolah->links() }}
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#arrKelurahan').select2();
            $('#arrKelurahan').on('change', function(e) {
                let data = $(this).val();
                @this.set('id_kelurahan', data);
            });
            window.livewire.on('productStore', () => {
                $('#arrKelurahan').select2();
            });
        });
    </script>
@endpush

<!-- Container-fluid Ends-->
