<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Dosen
        $dosenIds = [];
        for ($i = 0; $i < 5; $i++) {
            $dosenIds[] = DB::table('dosen')->insertGetId([
                'nama' => $faker->name,
                'image' => 'default.jpg',
                'deskripsi' => $faker->sentence(10),
                'content' => $faker->paragraphs(3, true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Tag
        $tagIds = [];
        for ($i = 0; $i < 10; $i++) {
            $tagIds[] = DB::table('tag')->insertGetId([
                'nama' => ucfirst($faker->unique()->word),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Publikasi
        $publikasiIds = [];
        for ($i = 0; $i < 10; $i++) {
            $publikasiIds[] = DB::table('publikasi')->insertGetId([
                'thumbnail' => 'default.jpg',
                'nama' => $faker->sentence(3),
                'deskripsi' => $faker->sentence(10),
                'content' => $faker->paragraphs(3, true),
                'dosen_id' => $faker->randomElement($dosenIds),
                'publish' => $faker->boolean(80),
                'highlight' => $faker->boolean(30),
                'tahun' => $faker->year,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Artikel
        $artikelIds = [];
        for ($i = 0; $i < 10; $i++) {
            $artikelIds[] = DB::table('artikel')->insertGetId([
                'thumbnail' => 'default.jpg',
                'nama' => $faker->sentence(3),
                'content' => $faker->paragraphs(4, true),
                'publish' => $faker->boolean(80),
                'highlight' => $faker->boolean(30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Agenda
        for ($i = 0; $i < 10; $i++) {
            $tanggal = $faker->dateTimeBetween('-1 years', '+1 years');
            DB::table('agenda')->insert([
                'thumbnail' => 'default.jpg',
                'nama' => $faker->sentence(3),
                'deskripsi' => $faker->sentence(10),
                'content' => $faker->paragraphs(3, true),
                'tanggal' => $tanggal->format('Y-m-d'),
                'sudah_lewat' => $tanggal < now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Kerjasama
        for ($i = 0; $i < 5; $i++) {
            DB::table('kerjasama')->insert([
                'thumbnail' => 'default.jpg',
                'nama' => $faker->company,
                'content' => $faker->paragraphs(3, true),
                'publish' => $faker->boolean(80),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Pivot artikel_tag
        foreach ($artikelIds as $artikelId) {
            $randomTags = $faker->randomElements($tagIds, rand(1, 3));
            foreach ($randomTags as $tagId) {
                DB::table('artikel_tag')->insert([
                    'artikel_id' => $artikelId,
                    'tag_id' => $tagId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Pivot publikasi_tag
        foreach ($publikasiIds as $publikasiId) {
            $randomTags = $faker->randomElements($tagIds, rand(1, 3));
            foreach ($randomTags as $tagId) {
                DB::table('publikasi_tag')->insert([
                    'publikasi_id' => $publikasiId,
                    'tag_id' => $tagId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
