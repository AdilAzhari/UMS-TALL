<?php

namespace App\Services;

class CourseService
{
    public function getCurrentCourses($user)
    {
        return $user->courses;
    }
}
