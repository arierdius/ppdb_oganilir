<div>
    <center>
        <h5>PENERIMAAN PESERTA DIDIK BARU JALUR {{ strtoupper($arrdata['data_jalur']) }} <br> TAHUN @php
            echo date('Y');
        @endphp
        </h5>
    </center>
    <table border="1" width="100%" style="font-size: 10px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Nomor Pendaftaran</th>
                <th>Nik</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Asal Sekolah</th>
                <th>Jarak</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($jenis_tarikan == 'seluruh')
                <tr>
                    <td colspan="12" style="background-color: gray;">Jalur Zonasi :
                        {{ $data_daya_tampung['porsi_zonasi'] }}% ({{ $atribut_jalur['total_zonasi'] }} Siswa) </td>
                </tr>

                @php
                    $total_pria_zonasi = 0;
                    $total_perempuan_zonasi = 0;
                @endphp

                @forelse ($data_pendaftar_zonasi as $key_pendaftar_zonasi)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>{{ $key_pendaftar_zonasi->detail->nama_lengkap }}</td>
                        <td>{{ $key_pendaftar_zonasi->no_pendaftaran }}</td>
                        <td>{{ $key_pendaftar_zonasi->detail->nik }}</td>
                        <td>{{ $key_pendaftar_zonasi->detail->tempat_lahir }}</td>
                        <td>{{ $key_pendaftar_zonasi->detail->tanggal_lahir }}</td>
                        <td>{{ $key_pendaftar_zonasi->detail->jenis_kelamin }}</td>
                        <td>{{ $key_pendaftar_zonasi->detail->agama }}</td>
                        <td>{{ $key_pendaftar_zonasi->sekolah->nama_sekolah }}</td>
                        <td>{{ $key_pendaftar_zonasi->jarak }} Meter</td>
                        <td>
                            @if ($key_pendaftar_zonasi->status == 'diterima')
                                Lulus
                            @else
                                Tidak Lulus
                            @endif
                        </td>
                    </tr>
                    @php
                        $total_pria_zonasi += $key_pendaftar_zonasi->detail->jenis_kelamin == 'laki-laki';
                        $total_perempuan_zonasi += $key_pendaftar_zonasi->detail->jenis_kelamin == 'perempuan';
                    @endphp
                @empty
                    <tr>
                        <td colspan="12">
                            <center>Data tidak tersedia</center>
                        </td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="12" style="background-color: gray;">Jalur Afirmasi :
                        {{ $data_daya_tampung['porsi_afirmasi'] }}% ({{ $atribut_jalur['total_afirmasi'] }} Siswa)
                    </td>
                </tr>

                {{-- zonasi ditambah dengan afirmasi --}}
                @php
                    $total_data1 = $atribut_jalur['total_zonasi'] + 1;

                    $total_pria_zonasi_afirmasi = 0;
                    $total_perempuan_afirmasi = 0;
                @endphp

                @forelse ($data_pendaftar_afirmasi as $key_pendaftar_afirmasi)
                    <tr>
                        <td>
                            @php
                                echo $total_data1++;
                            @endphp
                        </td>
                        <td>{{ $key_pendaftar_afirmasi->detail->nama_lengkap }}</td>
                        <td>{{ $key_pendaftar_afirmasi->no_pendaftaran }}</td>
                        <td>{{ $key_pendaftar_afirmasi->detail->nik }}</td>
                        <td>{{ $key_pendaftar_afirmasi->detail->tempat_lahir }}</td>
                        <td>{{ $key_pendaftar_afirmasi->detail->tanggal_lahir }}</td>
                        <td>{{ $key_pendaftar_afirmasi->detail->jenis_kelamin }}</td>
                        <td>{{ $key_pendaftar_afirmasi->detail->agama }}</td>
                        <td>{{ $key_pendaftar_afirmasi->sekolah->nama_sekolah }}</td>
                        <td>{{ $key_pendaftar_afirmasi->jarak }} Meter</td>
                        <td>
                            @if ($key_pendaftar_afirmasi->status == 'diterima')
                                Lulus
                            @else
                                Tidak Lulus
                            @endif
                        </td>
                    </tr>
                    @php
                        $total_pria_zonasi_afirmasi += $key_pendaftar_afirmasi->detail->jenis_kelamin == 'laki-laki';
                        $total_perempuan_afirmasi += $key_pendaftar_afirmasi->detail->jenis_kelamin == 'perempuan';
                    @endphp
                @empty
                    <tr>
                        <td colspan="12">
                            <center>Data tidak tersedia</center>
                        </td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="12" style="background-color: gray;">Jalur Mutasi :
                        {{ $data_daya_tampung['porsi_mutasi'] }}% ({{ $atribut_jalur['total_mutasi'] }} Siswa) </td>
                </tr>

                @php
                    $total_data2 = $atribut_jalur['total_zonasi'] + $atribut_jalur['total_afirmasi'] + 1;

                    $total_pria_zonasi_mutasi = 0;
                    $total_perempuan_mutasi = 0;
                @endphp
                @forelse ($data_pendaftar_mutasi as $key_pendaftar_mutasi)
                    <tr>
                        <td>
                            @php
                                echo $total_data2++;
                            @endphp
                        </td>
                        <td>{{ $key_pendaftar_mutasi->detail->nama_lengkap }}</td>
                        <td>{{ $key_pendaftar_mutasi->no_pendaftaran }}</td>
                        <td>{{ $key_pendaftar_mutasi->detail->nik }}</td>
                        <td>{{ $key_pendaftar_mutasi->detail->tempat_lahir }}</td>
                        <td>{{ $key_pendaftar_mutasi->detail->tanggal_lahir }}</td>
                        <td>{{ $key_pendaftar_mutasi->detail->jenis_kelamin }}</td>
                        <td>{{ $key_pendaftar_mutasi->detail->agama }}</td>
                        <td>{{ $key_pendaftar_mutasi->sekolah->nama_sekolah }}</td>
                        <td>{{ $key_pendaftar_mutasi->jarak }} Meter</td>
                        <td>
                            @if ($key_pendaftar_mutasi->status == 'diterima')
                                Lulus
                            @else
                                Tidak Lulus
                            @endif
                        </td>
                    </tr>
                    @php
                        $total_pria_zonasi_mutasi += $key_pendaftar_mutasi->detail->jenis_kelamin == 'laki-laki';
                        $total_perempuan_mutasi += $key_pendaftar_mutasi->detail->jenis_kelamin == 'perempuan';
                    @endphp
                @empty
                    <tr>
                        <td colspan="12">
                            <center>Data tidak tersedia</center>
                        </td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="12" style="background-color: gray;">Jalur Prestasi :
                        {{-- @php
                            $datass = $atribut_jalur['total_mutasi'] + $atribut_jalur['total_afirmasi'] + $atribut_jalur['total_zonasi']+1;
                        @endphp
                        : {{$datass}} --}}
                        {{ $data_daya_tampung['porsi_prestasi'] }}% ({{ $atribut_jalur['total_prestasi'] }} Siswa)
                    </td>
                </tr>

                @php
                    $datss = $atribut_jalur['total_mutasi'] + $atribut_jalur['total_afirmasi'] + $atribut_jalur['total_zonasi'] + 1;

                    $total_pria_zonasi_prestasi = 0;
                    $total_perempuan_prestasi = 0;
                @endphp
                @forelse ($data_pendaftar_prestasi as $key_pendaftar_prestasi)
                    <tr>
                        <td>
                            @php
                                echo $datss++;
                            @endphp
                        </td>
                        <td>{{ $key_pendaftar_prestasi->detail->nama_lengkap }}</td>
                        <td>{{ $key_pendaftar_prestasi->no_pendaftaran }}</td>
                        <td>{{ $key_pendaftar_prestasi->detail->nik }}</td>
                        <td>{{ $key_pendaftar_prestasi->detail->tempat_lahir }}</td>
                        <td>{{ $key_pendaftar_prestasi->detail->tanggal_lahir }}</td>
                        <td>{{ $key_pendaftar_prestasi->detail->jenis_kelamin }}</td>
                        <td>{{ $key_pendaftar_prestasi->detail->agama }}</td>
                        <td>{{ $key_pendaftar_prestasi->sekolah->nama_sekolah }}</td>
                        <td>{{ $key_pendaftar_prestasi->jarak }} Meter</td>
                        <td>
                            @if ($key_pendaftar_prestasi->status == 'diterima')
                                Lulus
                            @else
                                Tidak Lulus
                            @endif
                        </td>
                    </tr>
                    @php
                        $total_pria_zonasi_prestasi += $key_pendaftar_prestasi->detail->jenis_kelamin == 'laki-laki';
                        $total_perempuan_prestasi += $key_pendaftar_prestasi->detail->jenis_kelamin == 'perempuan';
                    @endphp
                @empty
                    <tr>
                        <td colspan="12">
                            <center>Data tidak tersedia</center>
                        </td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="2" style="text-align: right">Laki-laki</td>
                    <td>
                        @php
                            $subtotal_pria = $total_pria_zonasi + $total_pria_zonasi_afirmasi + $total_pria_zonasi_mutasi + $total_pria_zonasi_prestasi;
                        @endphp
                        <center>{{ $subtotal_pria }}</center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right">Perempuan</td>
                    <td>
                        @php
                            $subtotal_perempuan = $total_perempuan_zonasi + $total_perempuan_afirmasi + $total_perempuan_mutasi + $total_perempuan_prestasi;
                        @endphp
                        <center>{{ $subtotal_perempuan }}</center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right">Total</td>
                    <td>
                        <center>{{ $subtotal_perempuan + $subtotal_pria }}</center>
                    </td>
                </tr>
            @else
            @endif

        </tbody>
    </table>

    DAYA TAMPUNG UPT {{ Auth::user()->sekolah->nama_sekolah }}
    <table border="1" width="50%" style="font-size: 10px;">
        <thead>
            <tr>
                <th>NO</th>
                <th>JALUR</th>
                <th>PERSENTASE</th>
                <th>JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>ZONASI</td>
                <td>{{ $data_daya_tampung['porsi_zonasi'] }} %</td>
                <td>{{ $atribut_jalur['total_zonasi'] }} Siswa</td>
            </tr>
            <tr>
                <td>2</td>
                <td>AFIRMASI</td>
                <td>{{ $data_daya_tampung['porsi_afirmasi'] }} %</td>
                <td>{{ $atribut_jalur['total_afirmasi'] }} Siswa</td>
            </tr>
            <tr>
                <td>3</td>
                <td>PERPINDAHAN ORANG TUA</td>
                <td>{{ $data_daya_tampung['porsi_mutasi'] }} %</td>
                <td>{{ $atribut_jalur['total_mutasi'] }} Siswa</td>
            </tr>
            <tr>
                <td>4</td>
                <td>PRESTASI</td>
                <td>{{ $data_daya_tampung['porsi_prestasi'] }} %</td>
                <td>{{ $atribut_jalur['total_prestasi'] }} Siswa</td>
            </tr>
        </tbody>
    </table>

    <div style="float: left; margin-top: 50px;">
        <p>
            Data ini dicetak pada tanggal {{ date('d-m-Y') }}
        </p>
    </div>
</div>
