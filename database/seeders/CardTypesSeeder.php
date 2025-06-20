<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class CardTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CardType::insert([
            ['name' => 'Готов поделиться'],
            ['name' => 'Ищу в свою коллекцию'],
        ]);
    }
}
