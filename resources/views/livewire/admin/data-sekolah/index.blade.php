<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Master Sekolah</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Master Sekolah</li>
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
                        <button class="btn btn-pill btn-primary mb-3" wire:click="resetInput()" type="button"
                            data-bs-toggle="modal" data-original-title="test" data-bs-target="#TambahModal"> <i
                                class="fa fa-plus"></i>
                            Tambah
                            Data</button>

                        <div class="row">
                            <div class="col-12">
                                <select wire:model="id_sekolah" class="form-control" aria-label="Default select example"
                                    id="id_sekolah">
                                    <option value="">Pilih Sekolah</option>
                                    @foreach ($sekolah_filter as $key_sekolah)
                                        <option value="{{ $key_sekolah->id }}">
                                            {{ $key_sekolah->nama_sekolah }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Sekolah</th>
                                            <th>Alamat</th>
                                            <th>Kecamatan</th>
                                            <th>Telepon</th>
                                            <th>Kepsek</th>
                                            <th>Area Sekolah</th>
                                            <th>Situs Web</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($data_sekolah as $key_sekolah)
                                            {{-- @dd($key_sekolah->sekolah_area) --}}
                                            <tr>
                                                <td>{{ $data_sekolah->firstItem() + $loop->index }}</td>
                                                <td><a
                                                        href="{{ $key_sekolah->situs_web }}">{{ $key_sekolah->nama_sekolah }}</a>
                                                </td>
                                                <td>{{ $key_sekolah->alamat }}</td>
                                                <td>{{ $key_sekolah->kecamatan->nama_kecamatan }}</td>
                                                <td>{{ $key_sekolah->telepon }}</td>
                                                <td>{{ $key_sekolah->kepala_sekolah }}</td>
                                                <td>
                                                    @if ($key_sekolah->sekolah_area->count() > 0)
                                                        <a href="{{ route('admin.sekolah_area.index', $key_sekolah->id) }}"
                                                            target="_blank" type="button"
                                                            class="btn btn-warning btn-xs"><i class="fa fa-eye"></i>
                                                            kelola</a>
                                                    @else
                                                        <a href="{{ route('admin.sekolah_area.index', $key_sekolah->id) }}"
                                                            target="_blank" type="button"
                                                            class="btn btn-danger btn-xs"><i class="fa fa-eye"></i>
                                                            kelola</a>
                                                    @endif
                                                </td>
                                                <td>{{ $key_sekolah->situs_web }}</td>
                                                <td>
                                                    <a href="{{ route('admin.data_sekolah.edit', $key_sekolah->id) }}"
                                                        class="btn btn-primary btn-xs">Edit</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">
                                                    <center>PILIH JENIS SEKOLAH TERLEBIH DAHULU</center>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <br>
                                @if ($data_sekolah->hasPages())
                                    <div class="d-flex justify-content-center">
                                        {{ $data_sekolah->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="TambahModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Sekolah</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengumuman">Nama Sekolah</label>
                                <input wire:model="nama_sekolah" placeholder="Ketik Nama Sekolah"
                                    class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah">
                                @error('nama_sekolah')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengumuman">NPSN</label>
                                <input wire:model="npsn" placeholder="Ketik NISN" class="form-control" id="npsn">
                                @error('npsn')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengumuman">Kepala Sekolah</label>
                                <input wire:model="kepala_sekolah" placeholder="Ketik Nama Kepala Sekolah"
                                    class="form-control" id="kepala_sekolah">
                                @error('kepala_sekolah')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengumuman">Telepon</label>
                                <input wire:model="telepon" placeholder="Ketik Nomor Telepon Sekolah"
                                    class="form-control" id="telepon">
                                @error('telepon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div  class="col-12">
                                        <label class="col-form-label">Kelurahan</label>
                                        <select wire:model="kelurahan_id" class="form-control"
                                            aria-label="Default select example" id="kelurahan_id">
                                            <option value="">Pilih Sekolah</option>
                                            @foreach ($kelurahan as $key_kelurahan)
                                                <option value="{{ $key_kelurahan->id }}">
                                                    {{ $key_kelurahan->nama_kelurahan }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea wire:model="alamat" class="form-control" id="alamat" rows="3"></textarea>
                        @error('alamat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Batal</button>
                    <button type="button" wire:click.prevent="store()" class="btn btn-warning close-modal"
                        data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
    <script>
        $(document).ready(function() {
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
