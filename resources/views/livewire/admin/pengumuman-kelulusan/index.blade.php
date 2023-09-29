<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Pengumuman Kelullusan</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Pengumuman Kelulusan</li>
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
                                    <label class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <b>PPDB KABUPATEN OGAN ILIR TAHUN 2022/2023</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">STATUS PENGUMUMAN</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input class="form-control" disabled wire:model="pengumuman_kelulusan"
                                                type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-sm-12">
                        @if ($pengumuman_kelulusan == 'tidak-ditampilkan')
                            <button class="btn btn-success" wire:click.prevent="tampilkan()"
                                style="margin: 10px 30px 10px 0;float:right;" type="button">Tampilkan
                                Pengumuman</button>
                        @else
                            <button class="btn btn-warning" wire:click.prevent="jangan_tampilkan()"
                                style="margin: 10px 30px 10px 0;float:right;" type="button">Sembunyikan
                                Pengumuman</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
