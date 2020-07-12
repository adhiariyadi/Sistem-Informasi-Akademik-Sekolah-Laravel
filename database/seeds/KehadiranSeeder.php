<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KehadiranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kehadiran')->insert([
            'id' => 1,
            'ket' => 'Hadir',
            'color' => '3C0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('kehadiran')->insert([
            'id' => 2,
            'ket' => 'Izin',
            'color' => '0CF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('kehadiran')->insert([
            'id' => 3,
            'ket' => 'Bertugas Keluar',
            'color' => 'F90',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('kehadiran')->insert([
            'id' => 4,
            'ket' => 'Sakit',
            'color' => 'FF0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('kehadiran')->insert([
            'id' => 5,
            'ket' => 'Terlambat',
            'color' => '7F0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('kehadiran')->insert([
            'id' => 6,
            'ket' => 'Tanpa Keterangan',
            'color' => 'F00',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pengumuman')->insert([
            'id' => 1,
            'opsi' => 'pengumuman',
            'isi' => 'pengumuman',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
