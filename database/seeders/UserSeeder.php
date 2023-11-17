<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
            'firstname' => 'Mihailo',
            'lastname' => 'Ristov',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'type' => 'admin',
            'created_at' => Carbon::now(),
            ]
        ]);
    }
}
