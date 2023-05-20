<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_admin')->insert([
            [
                'username' => 'aristocaesar',
                'password' => 'aristo0407',
            ], [
                'username' => 'dewaayu',
                'password' => 'dewaayu',
            ]
        ]);
    }
}
