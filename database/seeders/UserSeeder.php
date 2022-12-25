<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
        [
            'name' => 'Admin',
            'email' => 'admin@localhost.com',
            'password' => bcrypt('admin'),
            'foto' => 'user.png',
            'id_level' => '1',
        ],
        [
            'name' => 'Karyawan',
            'email' => 'karyawan@localhost.com',
            'password' => bcrypt('123'),
            'foto' => 'user.png',
            'id_level' => '2',
        ]
        ));
    }
}
