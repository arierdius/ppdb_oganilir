<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Persyaratan Zonasi</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Persyaratan Zonasi</li>
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
                        <button wire:click.prevent="resetField()" class="btn btn-success" type="button" data-bs-toggle="modal" data-original-title="test"
                            data-bs-target="#exampleModal"><i class="fa fa-plus-square"></i> TAMBAH DATA</button>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation"wire:submit.prevent="update">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Surat</th>
                                            <th scope="col">File</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($persyaratan as $key_zonasi)
                                            @php
                                                $nama_surat = $key_zonasi->nama_surat;
                                                $new_nama_surat = strtr($nama_surat, '_', ' ');
                                            @endphp
                                            <tr>
                                                <td>{{ $persyaratan->firstItem() + $loop->index }}</td>
                                                <td>{{ ucwords($new_nama_surat) }}</td>
                                                <td>{{ $key_zonasi->nama_surat }}</td>
                                                <td>
                                                    <button wire:click.prevent="edit({{ $key_zonasi->id }})" type="button" data-bs-toggle="modal" data-original-title="test"
                                                    data-bs-target="#editExample" class="btn btn-primary btn-xs">Edit</button>
                                                    <button wire:click="$emit('triggerDelete',{{ $key_zonasi->id }})" class="btn btn-danger btn-xs" type="button">Delete</button>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse


                                    </tbody>

                                </table>
                                <br>
                                @if ($persyaratan->hasPages())
                                    <div class="d-flex justify-content-center">
                                        {{ $persyaratan->links() }}
                                    </div>
                                @endif
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Persyaratan</h5>
                </div>
                <form class="row g-3 needs-validation">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Nama Surat</label>
                            <input type="text" class="form-control @error('nama_surat') is-invalid @enderror"
                                id="validationCustom01" placeholder="Nama Surat" wire:model="nama_surat" required>
                            @error('nama_surat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" wire:click.prevent="store">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="editExample" tabindex="-1" role="dialog"
        aria-labelledby="editExampleLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Persyaratan</h5>
                </div>
                <form class="row g-3 needs-validation">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Nama Surat</label>
                            <input type="text" class="form-control @error('nama_surat') is-invalid @enderror"
                                id="validationCustom01" placeholder="Nama Surat" wire:model="nama_surat" required>
                            @error('nama_surat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" wire:click.prevent="update">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        @this.on('triggerDelete', id => {
            Swal.fire({
                title: 'Anda Ingin Menghapus??',
                html: "Kamu tidak dapat mengembalikan File ini!",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    @this.call('delete',id)
                }
            });
        });
    })
</script>
@endpush
