<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\BookCard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rejection>
 */
class RejectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rejected_by' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'book_card_id' => BookCard::inRandomOrder()->value('id') ?? BookCard::factory()->create()->id,
            'reason' => fake('ru_RU')->sentence(8, true),
            'rejected_at' => now(),
        ];
    }
}
