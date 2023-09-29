<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin Sekolah',
                'email' => 'adminsekolah@gmail.com',
                'role_id' => 1,
                'password' => bcrypt('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Muhammad Ari Erdius',
                'email' => 'arierdius@gmail.com',
                'role_id' => 2,
                'password' => bcrypt('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'role_id' => 3,
                'password' => bcrypt('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        User::insert($user);
    }
}
