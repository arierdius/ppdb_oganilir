<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
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

        $this->call([
            ProvinsiSeeder::class,
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            KelurahanSatuSeeder::class,
            KelurahanDuaSeeder::class,
            KelurahanTigaSeeder::class,
            KelurahanEmpatSeeder::class,
            KelurahanLimaSeeder::class,
            KelurahanEnamSeeder::class,
            KelurahanTujuhSeeder::class,
            KelurahanDelapanSeeder::class,
            UsersSeeder::class,
            SekolahSeeder::class,
        ]);
    }
}
