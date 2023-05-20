<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_artikel')->insert([
            [
                'judul_artikel' => 'Sunt reprehenderit eu ea commodo.',
                'isi_artikel' => 'Dolor elit voluptate nulla deserunt labore exercitation cupidatat qui culpa elit. Deserunt aliquip sint adipisicing adipisicing Lorem consectetur. Nostrud non exercitation labore amet eiusmod commodo in cillum proident consectetur tempor eu nostrud. Irure fugiat consequat velit Lorem laborum amet proident cupidatat eiusmod minim exercitation deserunt duis id.',
                'id_penulis' => 1,
                'tanggal' => (new DateTime())->format('Y-m-d')
            ],
            [
                'judul_artikel' => 'Exercitation pariatur minim labore.',
                'isi_artikel' => 'Dolor elit voluptate nulla deserunt labore exercitation cupidatat qui culpa elit. Deserunt aliquip sint adipisicing adipisicing Lorem consectetur. Nostrud non exercitation labore amet eiusmod commodo in cillum proident consectetur tempor eu nostrud. Irure fugiat consequat velit Lorem laborum amet proident cupidatat eiusmod minim exercitation deserunt duis id.',
                'id_penulis' => 1,
                'tanggal' => (new DateTime())->format('Y-m-d')
            ]
        ]);
    }
}
