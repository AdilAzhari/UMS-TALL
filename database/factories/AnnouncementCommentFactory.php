<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\AnnouncementComment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnnouncementComment>
 */
class AnnouncementCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'announcement_id' => \App\Models\Announcement::inRandomOrder()->first()->id,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'comment' => $this->faker->sentence(),
            'parent_id' => null,
            'commented_by' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
