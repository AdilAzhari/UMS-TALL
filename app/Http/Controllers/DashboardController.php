<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function __invoke()
    // {
    //     $user = Auth::user();
    //     // dd($user);
    //     return inertia('Dashboard', [
    //         'user' => $user,
    //         // 'announcements' => $user->announcements,
    //         // 'courses' => $user->courses,
    //         // 'weeks' => $user->weeks,
    //         // 'proctors' => $user->proctors,
    //         // 'technical_teams' => $user->technical_teams,
    //     ]);
    // }
    public function index(){
        return inertia('Dashboard', [
            'user' => Auth::user(),
        ]);
    }
}
