<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    public function getCurrentCourses($user)
    {
        return $user->courses;
    }

    public function availableCourses(): Course
    {
        return (new Course)->where('is_active', true)->get();
    }
}
