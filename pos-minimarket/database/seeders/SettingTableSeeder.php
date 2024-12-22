<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('setting')->insert([
            'id_setting' => 1,
            'nama_perusahaan' => 'Toko Kita',
            'alamat' => 'Jalan Gunung Patas Gg Dampang Sari II no 4',
            'telepon' => '0881038644485',
            'tipe_nota' => 1, //kecil
            'diskon' => 10,
            'path_logo' => asset('/img/logoToko.png'),
            'path_kartu_member' => asset('/img/member.png'),
        ]);
    }
}
