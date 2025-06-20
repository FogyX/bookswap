<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StatusSeeder::class,
            CardTypesSeeder::class,
            CoverTypeSeeder::class,
            BookConditionSeeder::class
        ]);

        \App\Models\User::factory()
            ->count(10)
            ->has(\App\Models\BookCard::factory()->count(7))
            ->create();
        \App\Models\Rejection::factory()->count(3)->create();

        // // Создать ещё по 4 карточки для каждого пользователя
        // \App\Models\User::all()->each(function ($user) {
        //     $user->bookCard()->saveMany(\App\Models\BookCard::factory()->count(4)->make());
        // });
    }
}
