<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Super Admin',
            'email' => 'adminSuper@gmail.com',
            'password' => bcrypt('123'),
            'level' => 1,
        ]);
    }
}
