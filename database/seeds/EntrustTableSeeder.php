<?php

use App\Models\LoginMahasiswa;
use App\Models\LoginPegawai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EntrustTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        LoginMahasiswa::insert([
//            'nomor' => 12615,
//            'email' => "nandarahman@it.student.pens.ac.id",
//            'password' => Hash::make("Nandareus05"),
//            'tanggal' => date('Y-m-d')
//        ]);
        LoginPegawai::insert([
            'nomor' => 347,
            'email' => "renggaasmara@pens.ac.id",
            'password' => Hash::make("rengga"),
            'tanggal' => date('Y-m-d')
        ]);

    }
}
