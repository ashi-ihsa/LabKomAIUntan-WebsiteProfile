<?php

namespace Database\Seeders;

use App\Models\Tentang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TentangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tentang')->insert([
            'content' => '<p>Selamat datang di halaman tentang kami.</p>',
        ]);
    }
}
