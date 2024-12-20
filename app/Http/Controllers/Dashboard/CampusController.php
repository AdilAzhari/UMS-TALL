<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CampusController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $user = auth()->user();
        assert($user != null);
=======
//        todo('list all the courses student taking this term');
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9

        return inertia::render('Campus/Index');
    }

<<<<<<< HEAD
    public function Announcements()
    {
        return inertia::render('Campus/Announcements');
=======
    public function course($id)
    {
        return inertia::render('Campus/Course');
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    }
}
