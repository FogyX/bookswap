<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BookCondition::insert([
            ['name' => 'Идеальное'],
            ['name' => 'Нормальное'],
            ['name' => 'Требует внимания'],
            ['name' => 'Плохое'],
        ]);
    }
}
