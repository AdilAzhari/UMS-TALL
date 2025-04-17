<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Link::factory(2)->create();
    }
}
