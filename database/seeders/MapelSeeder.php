<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapels = [
            ['nama' => 'Matematika', 'slug' => 'matematika', 'icon' => 'fa-calculator'],
            ['nama' => 'Sejarah Indonesia', 'slug' => 'sejarah-indonesia', 'icon' => 'fa-landmark'],
            ['nama' => 'Fisika', 'slug' => 'fisika', 'icon' => 'fa-flask'],
            ['nama' => 'Biologi', 'slug' => 'biologi', 'icon' => 'fa-leaf'],
            ['nama' => 'Bahasa Inggris', 'slug' => 'bahasa-inggris', 'icon' => 'fa-language'],
        ];

        foreach ($mapels as $mapel) {
            \App\Models\Mapel::create($mapel);
        }
    }
}
