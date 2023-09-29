<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\Provinsi;
use Illuminate\Database\Seeder;

class ProvinsiSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // sekolah
        
        $provinsi = [
            [
                'id' => 11,
                'nama_provinsi' => 'ACEH'
            ],
            [
                'id' => 12,
                'nama_provinsi' => 'SUMATERA UTARA'
            ],
            [
                'id' => 13,
                'nama_provinsi' => 'SUMATERA BARAT'
            ],
            [
                'id' => 14,
                'nama_provinsi' => 'RIAU'
            ],
            [
                'id' => 15,
                'nama_provinsi' => 'JAMBI'
            ],
            [
                'id' => 16,
                'nama_provinsi' => 'SUMATERA SELATAN'
            ],
            [
                'id' => 17,
                'nama_provinsi' => 'BENGKULU'
            ],
            [
                'id' => 18,
                'nama_provinsi' => 'LAMPUNG'
            ],
            [
                'id' => 19,
                'nama_provinsi' => 'KEPULAUAN BANGKA BELITUNG'
            ],
            [
                'id' => 21,
                'nama_provinsi' => 'KEPULAUAN RIAU'
            ],
            [
                'id' => 31,
                'nama_provinsi' => 'DKI JAKARTA'
            ],
            [
                'id' => 32,
                'nama_provinsi' => 'JAWA BARAT'
            ],
            [
                'id' => 33,
                'nama_provinsi' => 'JAWA TENGAH'
            ],
            [
                'id' => 34,
                'nama_provinsi' => 'DI YOGYAKARTA'
            ],
            [
                'id' => 35,
                'nama_provinsi' => 'JAWA TIMUR'
            ],
            [
                'id' => 36,
                'nama_provinsi' => 'BANTEN'
            ],
            [
                'id' => 51,
                'nama_provinsi' => 'BALI'
            ],
            [
                'id' => 52,
                'nama_provinsi' => 'NUSA TENGGARA BARAT'
            ],
            [
                'id' => 53,
                'nama_provinsi' => 'NUSA TENGGARA TIMUR'
            ],
            [
                'id' => 61,
                'nama_provinsi' => 'KALIMANTAN BARAT'
            ],
            [
                'id' => 62,
                'nama_provinsi' => 'KALIMANTAN TENGAH'
            ],
            [
                'id' => 63,
                'nama_provinsi' => 'KALIMANTAN SELATAN'
            ],
            [
                'id' => 64,
                'nama_provinsi' => 'KALIMANTAN TIMUR'
            ],
            [
                'id' => 65,
                'nama_provinsi' => 'KALIMANTAN UTARA'
            ],
            [
                'id' => 71,
                'nama_provinsi' => 'SULAWESI UTARA'
            ],
            [
                'id' => 72,
                'nama_provinsi' => 'SULAWESI TENGAH'
            ],
            [
                'id' => 73,
                'nama_provinsi' => 'SULAWESI SELATAN'
            ],
            [
                'id' => 74,
                'nama_provinsi' => 'SULAWESI TENGGARA'
            ],
            [
                'id' => 75,
                'nama_provinsi' => 'GORONTALO'
            ],
            [
                'id' => 76,
                'nama_provinsi' => 'SULAWESI BARAT'
            ],
            [
                'id' => 81,
                'nama_provinsi' => 'MALUKU'
            ],
            [
                'id' => 82,
                'nama_provinsi' => 'MALUKU UTARA'
            ],
            [
                'id' => 91,
                'nama_provinsi' => 'PAPUA BARAT'
            ],
            [
                'id' => 94,
                'nama_provinsi' => 'PAPUA'
            ]
            ];


            Provinsi::insert($provinsi);
        }
}
