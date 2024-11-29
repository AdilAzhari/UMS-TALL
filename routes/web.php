<?php

use App\Http\Controllers\Dashboard\AchievementsController;
use App\Http\Controllers\Dashboard\CampusController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\LinksController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\StoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryCommentController;
use App\Http\Controllers\StripeController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('user.profile');

Route::middleware('auth')->group(function () {
    Route::controller(CourseController::class)->group(function () {
        Route::get('/courses', 'index')->name('courses');
        Route::post('/courses/register', 'register')->name('courses.register');
        Route::get('/courses/manage', 'manage')->name('courses.manage');
        Route::get('/courses/registration', 'registration')->name('courses.registration');
        Route::get('/courses/proctors', 'proctors')->name('courses.proctors');
        Route::get('/courses/howto', 'howTo')->name('courses.howto');

        // web.php
        Route::get('/assign/proctorForm/{id}', 'showAssignProctorForm')->name('show.assign.proctorForm');
        Route::post('/assign/proctorForm/{courseID}', 'storeAssignProctorForm')->name('assign.proctorForm');
        Route::get('/proctor-response', 'response')->name('proctor.response')->middleware('signed');

    });
    Route::inertia('/assign/proctorForm', 'ProctorDetailsForm');

    Route::get('/achievements', [AchievementsController::class, 'index'])->name('achievements');
    // Route::get('/links', [LinksController::class, 'index'])->name('links');
    Route::get('/online-campus', [CampusController::class, 'index'])->name('online-campus');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('payments', PaymentController::class)->only(['index', 'create', 'store']);
    Route::controller(PaymentController::class)->group(function () {
        Route::get('/payments', 'index')->name('payments');
    });

    Route::controller(StripeController::class)->group(function () {
        Route::get('/payments/pay', 'pay')->name('payments.pay');
        Route::get('/payments/make', 'create')->name('payments.make');
        Route::get('/payments/success/{paymentId}', 'paymentSuccess')->name('payments.success');
        Route::get('/payments/cancel/{paymentId}', 'paymentCancel')->name('payments.cancel');
    });


    Route::controller(StoryController::class)->prefix('stories')->name('stories.')->group(function () {
        Route::get('/', 'index')->name('index'); // Index route comes first
        Route::get('/{story}/edit', 'edit')->name('edit');
        Route::get('/{slug}', 'show')->name('show'); // Show route for slug-based stories
        Route::post('/{id}/comments', 'storeComment')->name('comments.store');
    });


    Route::controller(StoryCommentController::class)->prefix('storyComment')->name('storyComment')->group(function () {
        Route::post('/{storyId}/comments', 'storeComment')->name('.store');
        Route::put('/{storyId}/comments/{commentId}', 'updateComment')->name('.update');
        Route::delete('/{storyId}/comments/{commentId}', 'destroyComment')->name('.destroy');
    });
    Route::get('/story/{storyId}/comments', [storyCommentController::class, 'index']);
    Route::get('/api/stories/{storyId}/comments', [storyCommentController::class, 'show']);
});

require __DIR__ . '/auth.php';
