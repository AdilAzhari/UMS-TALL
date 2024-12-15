<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CampusController extends Controller
{
    public function index()
    {
//        todo('list all the courses student taking this term');

        return inertia::render('Campus/Index');
    }

    public function course($id)
    {
        return inertia::render('Campus/Course');
    }
}
