<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nim' => '1941720150',
                'nama' => 'Octavia',
                'kelas' => 'TI-2C',
                'jurusan' => 'JTI',
                'no_handphone' => '08123243'
            ],
            [
                'nim' => '198676790',
                'nama' => 'Alya',
                'kelas' => 'TI-2C',
                'jurusan' => 'JTI',
                'no_handphone' => '086786767'
            ]
            ];

        DB::table('mahasiswas')->insert($data);
    }
}
