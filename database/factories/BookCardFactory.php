<?php

namespace Database\Factories;

use App\Models\BookCondition;
use App\Models\CardType;
use App\Models\CoverType;
use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookCard>
 */
class BookCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'author' => fake('ru_RU')->name(),
            'title' => fake('ru_RU')->sentence(3, true),
            'card_type_id' => CardType::inRandomOrder()->value('id'),
            'status_id' => Status::inRandomOrder()->value('id'),
            'publisher' => fake('ru_RU')->company(),
            'publication_year' => fake('ru_RU')->year(),
            'cover_type_id' => CoverType::inRandomOrder()->value('id'),
            'book_condition_id' => BookCondition::inRandomOrder()->value('id'),
            'created_at' => now(),
        ];
    }

    public function forUser(User $user): static
    {
        return $this->state([
            'user_id' => $user->id,
        ]);
    }
}
