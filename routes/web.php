<?php

use App\Http\Controllers\Dashboard\AchievementsController;
use App\Http\Controllers\Dashboard\AdmissionsController;
use App\Http\Controllers\Dashboard\CampusController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\FormController;
use App\Http\Controllers\Dashboard\LinksController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\StoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('user.profile');

Route::middleware('auth')->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::controller(CourseController::class)->group(function () {
        // Route::get('/courses', 'registrationSuccess')->name('courses.registration.success');
        Route::get('/courses', 'index')->name('courses');
        Route::post('/courses/register', 'register')->name('courses.register');
    });

    Route::get('/share', [StoryController::class, 'index'])->name('share');
    Route::get('/achievements', [AchievementsController::class, 'index'])->name('achievements');
    Route::get('/forms', [FormController::class, 'index'])->name('forms');
    Route::get('/admissions', [AdmissionsController::class, 'index'])->name('admissions');
    Route::get('/links', [LinksController::class, 'index'])->name('links');
    Route::get('/online-campus', action: [CampusController::class, 'index'])->name('online-campus');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
