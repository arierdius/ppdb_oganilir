<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Cetak Laporan</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Cetak Laporan</li>
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
                        <form class="row g-3 needs-validation"wire:submit.prevent="update">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>Tarik data laporan pendaftaran peserta didik baru tahun 2023 di
                                        {{ Auth::user()->sekolah->nama_sekolah }}</p>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Data</label>
                                    <select wire:model="jenis_data" class="form-control @error('jenis_data') is-invalid @enderror" >
                                        <option value="">--Pilih Jenis Laporan--</option>
                                        <option value="diterima">Lulus</option>
                                        <option value="ditolak">Tidak Lulus</option>
                                    </select>
                                    @error('jenis_data')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="row">

                                <div class="col-md-6 text-end">
                                    <button class="btn mt-3" style="background-color: #DAAE2B;" type="button"
                                        data-bs-toggle="modal" data-original-title="test"wire:click="cetakData"
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove>Cetak Laporan (Pdf)</span>
                                        <span wire:loading>Loading..</span>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn mt-3" style="background-color: #bdbdbd;" type="button"
                                        data-bs-toggle="modal" data-original-title="test"wire:click="cetakDataPendaftarExcel"
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove>Lap. Pendaftar (Excel)</span>
                                        <span wire:loading>Loading..</span>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn mt-3" style="background-color: #bdbdbd;" type="button"
                                        data-bs-toggle="modal" data-original-title="test"wire:click="cetakDataExcel"
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove>Lap. Siswa Lulus (Excel)</span>
                                        <span wire:loading>Loading..</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
