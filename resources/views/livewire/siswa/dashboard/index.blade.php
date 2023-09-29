<div>
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-xl-12 box-col-12 des-xl-100 dashboard-sec">
                <div class="card income-card" style="border-radius:6px;">
                    <center class="mt-3 mb-3"><b>
                            <h4>SELAMAT DATANG DI PPDB OGAN ILIR TAHUN @php
                                echo date('Y');
                            @endphp</h4>
                        </b></center>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-xl-6 box-col-6 des-xl-100 dashboard-sec">
                <div class="card income-card" style="border-radius:6px;">
                    <div class="card-header">
                        <center><b><i class="fa fa-info-circle"></i> PENGUMUMAN DARI DINAS PENDIDIKAN KABUPATEN OGAN
                                ILIR</b></center>
                    </div>
                    <div class="card-body">
                        <center>
                            <div class="table responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        @forelse ($pengumuman as $key_pengumuman)
                                            <tr>
                                                <th scope="row">-</th>
                                                <td>{{ $key_pengumuman->pengumuman }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <th scope="row">-</th>
                                                <td>Tidak ada pengumuman</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 box-col-6 des-xl-100 dashboard-sec">
                <div class="card income-card" style="border-radius:6px;">
                    <div class="card-header">
                        <center><b><i class="fa fa-info-circle"></i> DAFTAR JALUR YANG SEDANG DIBUKA</b></center>
                    </div>
                    <div class="card-body">
                        <center>
                            <div class="table responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <th>No</th>
                                        <th>Jalur</th>
                                        <th>Tanggal Buka</th>
                                        <th>Tanggal Tutup</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($jalur as $key_jalur)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $key_jalur->jalur }}</td>
                                                <td>
                                                    {{ date('d-m-Y', strtotime($key_jalur->tanggal_buka)) }}
                                                </td>
                                                <td>
                                                    {{ date('d-m-Y', strtotime($key_jalur->tanggal_tutup)) }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <th scope="row">No</th>
                                                <td>Tidak ada jalur yang dibuka</td>
                                                <td>-</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <center>
                <h6>BERKAS YANG DIBAWA KE CALON SEKOLAH UNTUK VERIFIKASI DATA CALON SISWA</h6>
            </center>
            <div class="container-fluid dashboard-default-sec">
                <div class="row">
                    <div class="col-xl-6 box-col-12 des-xl-100 dashboard-sec">
                        <div class="card income-card"
                            style="background-color: #E6997B;min-height:250px;border-radius:6px;">
                            <div class="card-header" style="background-color: #E6997B">
                                <b>AFIRMASI</b>
                                <small><b>(berkas diantar langsung oleh orang tua/wali)</b></small>
                            </div>
                            <div class="card-body">
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($pemberkasan_afirmasi as $key_afirmasi)
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ $no++ }}. {{ $key_afirmasi->nama_berkas }}
                                        </div>

                                    </div>
                                @empty
                                    -
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 box-col-12 des-xl-100 dashboard-sec">
                        <div class="card income-card"
                            style="background-color: #94D351;min-height:250px;border-radius:6px;">
                            <div class="card-header" style="background-color: #94D351">
                                <b>MUTASI</b>
                                <small><b>(berkas diantar langsung oleh orang tua/wali)</b></small>

                            </div>
                            <div class="card-body">
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($pemberkasan_mutasi as $key_mutasi)
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ $no++ }}. {{ $key_mutasi->nama_berkas }}
                                        </div>

                                    </div>
                                @empty
                                    -
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid dashboard-default-sec">
                <div class="row">
                    <div class="col-xl-6 box-col-12 des-xl-100 dashboard-sec">
                        <div class="card income-card"
                            style="background-color: #00B351;min-height:250px;border-radius:6px;">
                            <div class="card-header" style="background-color: #00B351">
                                <b>ZONASI</b>
                                <small><b>(dikumpul secara kolektif oleh sd/mi)</b></small>
                            </div>
                            <div class="card-body">
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($pemberkasan_zonasi as $key_zonasi)
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ $no++ }}. {{ $key_zonasi->nama_berkas }}
                                        </div>

                                    </div>
                                @empty
                                    -
                                @endforelse
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-6 box-col-12 des-xl-100 dashboard-sec">
                <div class="card income-card" style="background-color: #94D351">
                    <div class="card-header" style="background-color: #94D351">
                        <b>MUTASI</b>
                        <small><b>(berkas diantar langsung oleh orang tua/wali)</b></small>

                    </div>
                    <div class="card-body">
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($pemberkasan_mutasi as $key_mutasi)
                            <div class="row">
                                <div class="col-md-12">
                                   {{$no++;}}.  {{ $key_mutasi->nama_berkas }}
                                </div>

                            </div>
                        @empty
                            -
                        @endforelse
                    </div>
                </div>
            </div> --}}
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
    </div>
</div>
