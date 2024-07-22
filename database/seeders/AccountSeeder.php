<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'name' => 'Admin',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'author',
                'password' => Hash::make('author'),
                'name' => 'Author',
                'role' => 'author',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
