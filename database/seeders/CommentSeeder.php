<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_komentar')->insert([
            [
                'nama' => 'dindanugroho',
                'isi_komentar' => 'Aliqua cillum Lorem cillum dolor anim do irure quis excepteur.',
                'email' => 'dinda@gmail.com'
            ],
            [
                'nama' => 'dewayu',
                'isi_komentar' => 'Aliqua cillum Lorem cillum dolor anim do irure quis excepteur.',
                'email' => 'dewayu@gmail.com'
            ]
        ]);

        DB::table('tb_detail')->insert([
            [
                'id_artikel' => 1,
                'id_komentar' => 1
            ],
            [
                'id_artikel' => 2,
                'id_komentar' => 2
            ]
        ]);
    }
}
