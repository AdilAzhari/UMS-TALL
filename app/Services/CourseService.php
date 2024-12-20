<?php

namespace App\Services;

class CourseService
{
    public function getCurrentCourses($user)
    {
        return $user->courses;
    }

    public function availableCourses()
    {
        return Course::where('is_active', true)->get();
    }
}
