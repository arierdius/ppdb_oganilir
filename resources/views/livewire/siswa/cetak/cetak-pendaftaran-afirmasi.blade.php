<!DOCTYPE html>
<html>
<head>
	<title>KARTU PENDAFTARAN</title>
	<style type="text/css">
        body {
              font-family: Arial, Helvetica, sans-serif;
          }

		.grid-container {
			display: grid;
			grid-template-columns: auto auto;
			padding: 10px;
		}
        .tg  {border-collapse:collapse;}
        .tg td{font-family:Arial, sans-serif;font-size:14px;
          overflow:hidden;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;
          font-weight:normal;overflow:hidden;}
        .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
	</style>
</head>
<body>
	<table>
		<tr>
			<td style="width: 20px;"></td>
			<td style="width: 60px;"><img src="https://ppdb.oganilirkab.go.id/assets_umum/images/logo-oi.png" width="90" height="90"></td>
			<td style="width: 520px;">
			<center>
				<font size="5"><b>KARTU PENDAFTARAN</b></font><br>
				<font size="5"><b>PENERIMAAN PESERTA DIDIK BARU</b></font><br>
				<font size="5"><b>KABUPATEN OGAN ILIR TAHUN 2023</b></font><br>
			</center>
			</td>
			<td style="width: 80px;"></td>
		</tr>
		<tr>
			<td colspan="5"><hr style="border: 2px solid black;"></td>
		</tr>
	</table>
  	<br>
  	<br>
    <table class="tg">
    <thead>
      <tr>
        <th class="tg-0pky" width="150">NOMOR PENDAFTARAN</th>
        <th class="tg-0pky" width="10">:</th>
        <th class="tg-0pky" width="290">{{ $pendaftaran->no_pendaftaran }}</th>
        <th class="tg-0pky" rowspan="5"><img style="border: 2px solid #000000;" src="https://ppdb.oganilirkab.go.id/storage/foto_siswa/{{ $pendaftaran->detail->foto }}" width="110" height="170"></th>
      </tr>
      <tr>
        <th class="tg-0pky">JALUR PENDAFTARAN</th>
        <th class="tg-0pky">:</th>
        <th class="tg-0pky">{{ strtoupper($pendaftaran->jalur) }}</th>
      </tr>
      <tr>
        <th class="tg-0pky">TANGGAL PENDAFTARAN</th>
        <th class="tg-0pky">:</th>
        <th class="tg-0pky">{{ date('d-m-Y', strtotime($pendaftaran->tanggal_daftar)) }}</th>
      </tr>
      <br>
      <tr>
        <th class="tg-0pky">NAMA</th>
        <th class="tg-0pky">:</th>
        <th class="tg-0pky">{{ strtoupper($pendaftaran->detail->nama_lengkap) }}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="tg-0pky">NIK</td>
        <td class="tg-0pky">:</td>
        <td class="tg-0pky">{{ $pendaftaran->detail->nik }}</td>
        <td class="tg-0pky" rowspan="3"><img src="https://ppdb.oganilirkab.go.id/storage/foto_siswa/qr-code.png" width="110" height="110"></td>
      </tr>
      <tr>
        <td class="tg-0pky">TEMPAT LAHIR</td>
        <td class="tg-0pky">:</td>
        <td class="tg-0pky">{{ $pendaftaran->detail->tempat_lahir }}</td>
      </tr>
      <tr>
        <td class="tg-0pky">TANGGAL LAHIR</td>
        <td class="tg-0pky">:</td>
        <td class="tg-0pky">{{ date('d-m-Y', strtotime($pendaftaran->detail->tanggal_lahir)) }}</td>
      </tr>
      <br>
      <br>
      <tr>
        <td class="tg-0pky">PILIHAN SEKOLAH</td>
        <td class="tg-0pky"></td>
        <td class="tg-0pky"></td>
        <td class="tg-0pky"></td>
      </tr>
      <br>
      <tr>
        <td class="tg-0pky">NAMA SEKOLAH</td>
        <td class="tg-0pky">:</td>
        <td class="tg-0pky">{{ strtoupper($pendaftaran->sekolah->nama_sekolah) }}</td>
        <td class="tg-0pky"></td>
      </tr>
      <br>
      <tr>
        <td class="tg-0pky">ALAMAT SEKOLAH</td>
        <td class="tg-0pky">:</td>
        <td class="tg-0pky">{{ $pendaftaran->sekolah->alamat }} </td>
        <td class="tg-0pky"></td>
      </tr>
      <br>
      <br>
      <tr>
        <td class="tg-0pky">PERHATIAN :</td>
        <td class="tg-0pky"></td>
        <td class="tg-0pky"></td>
        <td class="tg-0pky"></td>
      </tr>
      <tr>
        <td class="tg-0pky" colspan="4">1. Kartu Pendaftaran ini dicetak dan wajib dibawa pada saat verifikasi berkas.</td>
      </tr>
      <tr>
        <td class="tg-0pky" colspan="4"><span style="font-weight:400;font-style:normal">2. Jaga kerahasiaan data pribadi yang tertera pada Kartu Pendaftaran ini.</span></td>
      </tr>
      <tr>
        <td class="tg-0pky" colspan="4"><span style="font-weight:400;font-style:normal">3. Data dan dokumen yang diinput oleh pendaftar pada Aplikasi PPDB adalah benar. Apabila dikemudian hari diketahui bahwa data dan dokumen yang diinput tidak benar, maka pendaftar siap bertanggung jawab untuk menerima konsekuensi sesuai dengan peraturan yang berlaku.</span></td>
      </tr>
    </tbody>
    </table>
</body>
</html>
