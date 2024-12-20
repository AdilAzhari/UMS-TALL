<?php

namespace Database\Seeders;

use App\Models\ProgramStatuse;
use Illuminate\Database\Seeder;

class ProgramStatuseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramStatuse::factory()->count(7)->create();
    }
}
