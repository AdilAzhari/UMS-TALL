<?php

namespace Database\Seeders;

use App\Models\department;
use App\Models\enrollment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use WorldCitiesLocaleTableSeeder;
use WorldCitiesTableSeeder;
use WorldContinentsLocaleTableSeeder;
use WorldContinentsTableSeeder;
use WorldCountriesTableSeeder;
use WorldDivisionsTableSeeder;
use WorldTablesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
        //     // UserSeeder::class,
        //     // departmentSeeder::class,
        //     // StudentSeeder::class,
        //     programSeeder::class,

        //     // AttendanceSeeder::class,
        //     CourseSeeder::class,
        //     AssignmentSeeder::class,
        //     AssignmentSubmissionSeeder::class,
        //     // CourseRegistrationSeeder::class,
        //     ExamSeeder::class,
        //     ExamResultSeeder::class,
        //     enrollmentSeeder::class,
        //     // PaymentSeeder::class,
        //     GradingScaleSeeder::class,
        //     teacherSeeder::class,
        //     TermSeeder::class,
        //     classSeeder::class,
        //     NotificationSeeder::class,
        // ]);
        WorldCountriesTableSeeder::class,
        WorldCitiesLocaleTableSeeder::class,
        WorldCitiesTableSeeder::class,
        WorldContinentsTableSeeder::class,
        WorldContinentsLocaleTableSeeder::class,
        WorldTablesSeeder::class,
        WorldDivisionsTableSeeder::class,
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        ]);
    }
}
