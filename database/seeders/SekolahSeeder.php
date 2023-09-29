<?php

namespace Database\Seeders;

use App\Models\Admin\Sekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sekolah = [
            [
                'npsn' => '20100001',
                'nama_sekolah' => 'TK Darma Wanita Bangun Jaya',
                'alamat' => 'JL. KOTA NO. 1',
                'jenis_sekolah_id' => '1',
                'kecamatan_id' => '1610',
                'telepon' => '081234567890',
                'latitude' => '-6.9039',
                'longitude' => '107.6186',
                'kepala_sekolah' => 'Sri Wahyuni',
                'faksmili' => '081234567890',
                'akreditasi' => 'A',
                'surel' => 'tkdarmawanita@gmail.com',
                'situs_web' => 'tkdarmawanita.sch.id',
                'foto' => 'tkdarmawanita.jpg',
                'logo' => 'tkdarmawanita.jpg',
                'visi_misi' => 'visi misi',
                'created_at' => now(),
            ],
            [
                'npsn' => '20100001',
                'nama_sekolah' => 'SDN 3 Seritanjung',
                'alamat' => 'JL. KOTA NO. 1',
                'jenis_sekolah_id' => '2',
                'kecamatan_id' => '1610',
                'telepon' => '081234567890',
                'latitude' => '-6.9039',
                'longitude' => '107.6186',
                'kepala_sekolah' => 'Rusmawati',
                'faksmili' => '081234567890',
                'akreditasi' => 'A',
                'surel' => 'sdn3seritanjung@gmail.com',
                'situs_web' => 'sdn3seritanjung.sch.id',
                'foto' => 'sdn3seritanjung.jpg',
                'logo' => 'sdn3seritanjung.jpg',
                'visi_misi' => 'visi misi',
                'created_at' => now(),
            ],
            [
                'npsn' => '20100001',
                'nama_sekolah' => 'SMPN 2 Tanjung Batu',
                'alamat' => 'JL. KOTA NO. 1',
                'jenis_sekolah_id' => '3',
                'kecamatan_id' => '1610',
                'telepon' => '081234567890',
                'latitude' => '-6.9039',
                'longitude' => '107.6186',
                'kepala_sekolah' => 'Sri Wahyuni',
                'faksmili' => '081234567890',
                'akreditasi' => 'A',
                'surel' => 'smpn2seribandung@gmail.com',
                'situs_web' => 'smpn2seribandung.sch.id',
                'foto' => 'smpn2seribandung.jpg',
                'logo' => 'smpn2seribandung.jpg',
                'visi_misi' => 'visi misi',
                'created_at' => now(),
            ],
        ];

        Sekolah::insert($sekolah);
    }
}
