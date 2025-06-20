<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CoverTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CoverType::insert([
            ['name' => 'Твёрдый'],
            ['name' => 'Мягкий'],
        ]);
    }
}
