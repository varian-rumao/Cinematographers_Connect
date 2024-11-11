<?php

namespace Database\Factories;

use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    protected $model = UserProfile::class;

    public function definition()
    {
        return [
            'bio' => $this->faker->paragraph,
            'profile_picture' => $this->faker->imageUrl(),
            'location' => $this->faker->city,
            'website' => $this->faker->url,
            'user_id' => \App\Models\User::factory(), // Creates a user automatically
        ];
    }
}
