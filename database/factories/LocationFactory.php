<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(), // Create or link to a user
            'place_name' => $this->faker->city,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'lead_time' => $this->faker->numberBetween(5, 60), // Lead time in minutes
            'notification_method' => $this->faker->randomElement(['email', 'sms', 'both']),
            'cloud_threshold' => $this->faker->numberBetween(0, 100), // Cloud coverage percentage
    
            //
        ];
    }
}
