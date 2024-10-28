<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courses>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 0;

        $courses = [
            ['name' => 'Introduction to Computer Science', 'code' => 'CS101', 'credit' => 3, 'description' => 'Basic concepts of computer science.'],
            ['name' => 'Calculus I', 'code' => 'MATH101', 'credit' => 4, 'description' => 'Introduction to differential and integral calculus.'],
            ['name' => 'Physics I', 'code' => 'PHYS101', 'credit' => 4, 'description' => 'Fundamentals of mechanics and thermodynamics.'],
            ['name' => 'Introduction to Psychology', 'code' => 'PSYC101', 'credit' => 3, 'description' => 'Foundations of psychological theories and principles.'],
            ['name' => 'History of Western Civilization', 'code' => 'HIST101', 'credit' => 3, 'description' => 'Survey of Western civilization from ancient times to the present.'],
            ['name' => 'Introduction to Sociology', 'code' => 'SOC101', 'credit' => 3, 'description' => 'Basic principles of sociological theory and practice.'],
            ['name' => 'Programming Fundamentals', 'code' => 'CS102', 'credit' => 3, 'description' => 'Basic programming concepts using modern programming languages.'],
            ['name' => 'Database Management Systems', 'code' => 'CS201', 'credit' => 3, 'description' => 'Introduction to database design and management.'],
            ['name' => 'Discrete Mathematics', 'code' => 'MATH201', 'credit' => 3, 'description' => 'Fundamentals of discrete mathematical structures.'],
            ['name' => 'English Composition', 'code' => 'ENG101', 'credit' => 3, 'description' => 'Developing skills in writing clear, organized, and well-supported essays.'],
            ['name' => 'Introduction to Business', 'code' => 'BUS101', 'credit' => 3, 'description' => 'Foundations of business principles and practices.'],
            ['name' => 'Statistics for Business', 'code' => 'BUS201', 'credit' => 3, 'description' => 'Introduction to statistical methods and their applications in business.'],
            ['name' => 'Financial Accounting', 'code' => 'ACCT101', 'credit' => 3, 'description' => 'Basic principles of financial accounting.'],
            ['name' => 'Marketing Principles', 'code' => 'MKTG101', 'credit' => 3, 'description' => 'Foundations of marketing concepts and strategies.'],
            ['name' => 'Managerial Accounting', 'code' => 'ACCT201', 'credit' => 3, 'description' => 'Advanced principles of managerial accounting.'],
            ['name' => 'Organizational Behavior', 'code' => 'MGMT101', 'credit' => 3, 'description' => 'Understanding human behavior in organizational settings.'],
            ['name' => 'International Business', 'code' => 'MGMT201', 'credit' => 3, 'description' => 'Introduction to global business operations and international trade.'],
            ['name' => 'Human Resource Management', 'code' => 'MGMT301', 'credit' => 3, 'description' => 'Principles and practices of human resource management.'],
            ['name' => 'Strategic Management', 'code' => 'MGMT302', 'credit' => 3, 'description' => 'Strategic planning and decision-making in organizations.'],
            ['name' => 'Entrepreneurship', 'code' => 'MGMT401', 'credit' => 3, 'description' => 'Introduction to entrepreneurship and innovation.'],
            ['name' => 'Marketing Management', 'code' => 'MKTG201', 'credit' => 3, 'description' => 'Advanced concepts and strategies in marketing management.'],
            ['name' => 'Operations Management', 'code' => 'MGMT402', 'credit' => 3, 'description' => 'Principles and practices of operations management.'],
            ['name' => 'Financial Management', 'code' => 'FINC201', 'credit' => 3, 'description' => 'Principles and practices of financial management.'],
            ['name' => 'Management Information Systems', 'code' => 'MGMT403', 'credit' => 3, 'description' => 'Introduction to management information systems and their role in business operations.'],
            ['name' => 'Business Law', 'code' => 'LAW101', 'credit' => 3, 'description' => 'Introduction to business law and its impact on business operations.'],
            ['name' => 'International Finance', 'code' => 'FINC301', 'credit' => 3, 'description' => 'Principles and practices of international finance.'],
            ['name' => 'Strategic Leadership', 'code' => 'MGMT404', 'credit' => 3, 'description' => 'Leadership theories and practices in organizational contexts.'],
            ['name' => 'Advanced Accounting', 'code' => 'ACCT301', 'credit' => 3, 'description' => 'Advanced principles of accounting.'],
            ['name' => 'Strategic Marketing', 'code' => 'MKTG301', 'credit' => 3, 'description' => 'Advanced concepts and strategies in marketing management.'],
            ['name' => 'Advanced Management', 'code' => 'MGMT405', 'credit' => 3, 'description' => 'Advanced management theories and practices.'],
            ['name' => 'Entrepreneurship and Venture Creation', 'code' => 'MGMT406', 'credit' => 3, 'description' => 'Introduction to entrepreneurship and innovation.'],
            ['name' => 'International Business', 'code' => 'MGMT407', 'credit' => 3, 'description' => 'Introduction to global business operations and international trade.'],
            ['name' => 'Advanced Financial Management', 'code' => 'FINC401', 'credit' => 3, 'description' => 'Advanced principles of financial management.'],
            ['name' => 'Advanced Management Information Systems', 'code' => 'MGMT408', 'credit' => 3, 'description' => 'Advanced concepts and strategies in management information systems.'],
            ['name' => 'Business Ethics', 'code' => 'MGMT409', 'credit' => 3, 'description' => 'Ethical decision-making in business contexts.'],
            ['name' => 'Global Business Environment', 'code' => 'MGMT410', 'credit' => 3, 'description' => 'Understanding global business trends and their impact on organizations.'],
        ];
        $course = $courses[$counter % count($courses)];
        $counter++;

        return [
            'name' => $course['name'],
            'code' => $course['code'],
            'credit' => $course['credit'],
            'description' => $course['description'],
            'syllabus' => $this->faker->word(),
            'image' => $this->faker->url(),
            'status' => $this->faker->boolean(),
            'requier_proctor' => $this->faker->boolean(),
            'paid' => $this->faker->randomElement(['paid', 'unpaid', 'future_payment']),
            'cost' => $this->faker->randomFloat(2, 0, 150),
            'program_id' => \App\Models\Program::inRandomOrder()->first()->id,
            'course_category_id' => \App\Models\CourseCategory::inRandomOrder()->first()->id,
            'prerequisite_course_id' => \App\Models\Course::inRandomOrder()->first()->id ?? null,
        ];
    }
}
