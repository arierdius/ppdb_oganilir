<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Kontak Kami</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Kontak Kami</li>
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
                    {{-- <div class="card-header pb-0">
                        <h5>Basic HTML input control</h5>
                    </div> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Telp / WA</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input class="form-control" type="text" wire:model="telp"
                                                placeholder="No Telpon">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input class="form-control" wire:model="email" type="text"
                                                placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="5" cols="5" placeholder="Default textarea" wire:model="alamat"></textarea>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button class="btn btn-primary" wire:click.prevent="update()"
                            style="margin: 10px 30px 10px 0;float:right;" type="button">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
