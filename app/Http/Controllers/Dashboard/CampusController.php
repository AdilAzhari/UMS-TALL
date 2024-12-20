<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CampusController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        assert($user != null);

        return inertia::render('Campus/Index');
    }

    public function Announcements()
    {
        return inertia::render('Campus/Announcements');
    }
}
