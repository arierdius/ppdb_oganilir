<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SekolahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => fake()->unique()->randomNumber(),
            'nama_sekolah' => fake()->unique()->name(),
            'npsn' =>  fake()->unique()->randomNumber(),
            'alamat' => fake()->address(),
            'jenis_sekolah_id' => fake()->randomNumber(),
            'kecamatan_id' => fake()->randomNumber(),
            'telepon' => fake()->phoneNumber(),
            'kepala_sekolah' => fake()->name(),
            'faksmili' => fake()->phoneNumber(),
            'Akreditasi' => fake()->randomNumber(),
            'surel' => fake()->email(),
            'situs_web' => fake()->url(),
            'foto' => fake()->imageUrl(),
            'logo' => fake()->imageUrl(),
            'visi_misi' => fake()->text(),
        ];
    }
}
