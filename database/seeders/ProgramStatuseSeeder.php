<?php

namespace Database\Seeders;

use App\Models\ProgramStatus;
use Illuminate\Database\Seeder;

class ProgramStatuseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramStatus::factory()->count(7)->create();
    }
}
