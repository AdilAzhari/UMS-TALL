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

// Route::get('/online-campus', function () {
//     return Inertia::render('Contact');
// })->name('online-campus');
// Route::get('links', function () {
//     return Inertia::render('Contact');
// })->name('links');
// Route::get('admissions', function () {
//     return Inertia::render('Contact');
// })->name('admissions');
// Route::get( 'forms', function () {
//     return Inertia::render('Contact');
// })->name('forms');
// Route::get('achievements', function () {
//     return Inertia::render('Contact');
// })->name('achievements');
// Route::get('share', function () {
//     return Inertia::render('Contact');
// })->name('share');
// Route::get('courses', function () {
//     return Inertia::render('Contact');
// })->name('courses');
// Route::get('payments', function () {
//     return Inertia::render('Contact');
// })->name('payments');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
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
