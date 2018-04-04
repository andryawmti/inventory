<?php

use Illuminate\Database\Seeder;
use App\Pengaturan;
use App\Satuan;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(PengaturansSeeder::class);
        $pengaturan = Pengaturan::create(array(
            'nama_sistem' => 'Sistem Inventory',
            'nama_perusahaan' => 'Perusahaan Alim Rugi',
            'alamat_perusahaan' => 'RT5 RW3 No 10 Jalan Cinta',
            'no_telepon' => '1234554545',
            'keterangan' => 'Si Herp',
        ));

//        Satuan::create(array(
//            'nama_satuan' => 'Pcs',
//            'created_at' => date('c'),
//            'updated_at' => date('c'),
//        ));
//        Satuan::create(array(
//            'nama_satuan' =>'Buah',
//            'created_at' => date('c'),
//            'updated_at' => date('c'),
//        ));
//        Satuan::create(array(
//            'nama_satuan'=>'Dus',
//            'created_at' => date('c'),
//            'updated_at' => date('c'),
//        ));
//        Satuan::create(array(
//            'nama_satuan'=>'Bungkus',
//            'created_at' => date('c'),
//            'updated_at' => date('c'),
//        ));
//        Satuan::create(array(
//            'nama_satuan'=>'Box',
//            'created_at' => date('c'),
//            'updated_at' => date('c'),
//        ));
//        Satuan::create(array(
//            'nama_satuan'=>'Pack',
//            'created_at' => date('c'),
//            'updated_at' => date('c'),
//        ));
    }
}
