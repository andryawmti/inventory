<?php

use Illuminate\Database\Seeder;
use App\Pengaturan;

class PengaturansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pengaturan = Pengaturan::create(array(
            'nama_sistem' => 'Sistem Inventory',
            'nama_perusahaan' => 'Perusahaan Alim Rugi',
            'alamat_perusahaan' => 'RT5 RW3 No 10 Jalan Cinta',
            'no_telp' => '1234554545',
            'keterangan' => 'Si Herp',
        ));
    }
}
