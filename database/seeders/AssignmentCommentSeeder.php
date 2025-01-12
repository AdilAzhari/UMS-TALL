<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\AssignmentComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssignmentComment::factory()->count(10)->create();
    }
}