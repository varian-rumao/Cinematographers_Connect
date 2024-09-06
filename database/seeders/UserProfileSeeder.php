<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;

class UserProfileSeeder extends Seeder
{
    public function run()
    {
        // Create 10 users and their associated profiles
        User::factory()
            ->count(10)
            ->has(UserProfile::factory())
            ->create();
    }
}
