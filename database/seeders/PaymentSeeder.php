<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Payment::factory(1000)->create();
    }
}
