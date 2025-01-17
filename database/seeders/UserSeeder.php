<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->updateOrInsert(
            ['username' => 'admin'], // Kondisi pencarian
            ['password' => Hash::make('oo')] // Data yang akan diperbarui atau disisipkan
        );
    }
}