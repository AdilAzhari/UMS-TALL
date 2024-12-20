<?php

namespace Database\Factories;

use App\Models\Story;
use App\Models\StoryComment;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StoryComment>
 */
class StoryCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->paragraphs(3, true),
<<<<<<< HEAD
            'story_id' => Story::inRandomOrder()->first()->id ?? Story::factory()->create(),
            'student_id' => Student::inRandomOrder()->first()->id ?? Student::factory()->create(),
=======
            'story_id' => Story::factory() ?? null,
            'student_id' => Student::factory() ?? null,
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
            'status' => $this->faker->randomElement(['draft', 'published']),
            'parent_id' => null ?? null,
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
