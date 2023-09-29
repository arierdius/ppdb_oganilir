<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Profil Sekolah</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Profil-Sekolah</li>
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
                        <div class="row">
                            <div class="col-6">
                                <select wire:model="jenis_sekolah" class="form-control"
                                    aria-label="Default select example" id="jenis_sekolah">
                                    <option selected>Pilih Jenis Sekolah</option>
                                    <option value="1">TK</option>
                                    <option value="2">SD</option>
                                    <option value="3">SMP</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <select wire:model="id_sekolah" class="form-control" aria-label="Default select example"
                                    id="id_sekolah">
                                    <option selected>Pilih Sekolah</option>
                                    @forelse ($data_sekolah as $key_data_sekolah)
                                        <option value="{{ $key_data_sekolah->id }}">
                                            {{ $key_data_sekolah->nama_sekolah }}</option>
                                    @empty
                                        <option value="#">Pilih Jenis Sekolah Dulu</option>
                                    @endforelse
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
                                            <th>Logo</th>
                                            <th>Npsn</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Faksimili</th>
                                            <th>Akreditasi</th>
                                            <th>Surat Elektronik</th>
                                            <th>Situs Web</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sekolah as $key_sekolah)
                                            <td>{{ $sekolah->firstItem() + $loop->index }}</td>
                                            <td>{{ $key_sekolah->nama_sekolah }}</td>
                                            <td>{{ $key_sekolah->logo }}</td>
                                            <td>{{ $key_sekolah->npsn }}</td>
                                            <td>{{ $key_sekolah->alamat }}</td>
                                            <td>{{ $key_sekolah->telepon }}</td>
                                            <td>{{ $key_sekolah->faksmili }}</td>
                                            <td>{{ $key_sekolah->akreditasi }}</td>
                                            <td>{{ $key_sekolah->surel }}</td>
                                            <td>{{ $key_sekolah->situs_web }}</td>
                                        @empty
                                            <tr>
                                                <td colspan="8">Data Tidak Tersedia</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
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
            $('#jenis_sekolah').select2().on('change', function(e) {
                @this.set('jenis_sekolah', e.target.value);
            });

            $('#id_sekolah').select2().on('change', function(e) {
                @this.set('id_sekolah', e.target.value);
            });
        });
    </script>
@endpush

<!-- Container-fluid Ends-->
