<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Daya Tampung</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Daya Tampung</li>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rombel</label>
                                    <input type="text" class="form-control @error('rombel') is-invalid @enderror"
                                        placeholder="Ex : 6" autofocus wire:model="rombel">
                                        <small>Jumlah siswa dalam 1 rombel maksimal 32 siswa</small>
                                        @error('rombel')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Daya Tampung</label>
                                    <input type="text"
                                        class="form-control @error('daya_tampung') is-invalid @enderror"
                                        placeholder="Masukkan Daya Tampung" autofocus wire:model="daya_tampung">
                                    @error('daya_tampung')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 text-end">
                                <button type="button" class="btn btn-primary" wire:click="update"
                                    {{ $total_tampungan }}>Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($daya_tampung != null)
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                <center>Porsi Penerimaan</center>
                            </h5>
                        </div>
                        <div class="card-body">
                            <form class="row g-3 needs-validation"wire:submit.prevent="update">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Jalur Pendaftaran</th>
                                                <th scope="col">%</th>
                                                <th scope="col">Porsi Siswa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Zonasi</td>
                                                <td>{{ $porsi_siswa->zonasi }} %</td>
                                                <td>
                                                    @php
                                                        $zonasi = ($porsi_siswa->zonasi * $daya_tampung) / 100;
                                                        echo $zonasi . ' Siswa';
                                                    @endphp
                                                    (<b>Minimal</b>)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Prestasi</td>
                                                <td>{{ $porsi_siswa->prestasi }} %</td>
                                                <td>
                                                    @php
                                                        $prestasi = ($porsi_siswa->prestasi * $daya_tampung) / 100;
                                                        echo $prestasi . ' Siswa';
                                                    @endphp
                                                    (<b>Minimal</b>)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Afirmasi</td>
                                                <td>{{ $porsi_siswa->afirmasi }} %</td>
                                                <td>
                                                    @php
                                                        $afirmasi = ($porsi_siswa->afirmasi * $daya_tampung) / 100;
                                                        echo $afirmasi . ' Siswa';
                                                    @endphp
                                                    (<b>Minimal</b>)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Perpindahan Orang Tua</td>
                                                <td>{{ $porsi_siswa->pindah_tugas }} %</td>
                                                <td>
                                                    @php
                                                        $perpindahan = ($porsi_siswa->pindah_tugas * $daya_tampung) / 100;
                                                        echo $perpindahan . ' Siswa';
                                                    @endphp
                                                    (<b>Minimal</b>)
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>
