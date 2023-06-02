<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\Consultation::class;

    public function definition(): array
    {
        return [
            'user_id' =>  \App\Models\User::factory(),
            'date_and_time' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'subject' => $this->faker->words(3, true),
            'info' => $this->faker->text(30),
            'link' => $this->faker->url(),
            'type' => $this->faker->randomElement(['Just consulting', 'Tests consultation', 'Exam consultation', 'Course projects', 'For work at labs']),
        ];
    }
}