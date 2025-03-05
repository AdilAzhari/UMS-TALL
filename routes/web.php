<?php

use App\Http\Controllers\AcademicProgressController;
use App\Http\Controllers\Campus\CampusController;
use App\Http\Controllers\Dashboard\AchievementsController;
use App\Http\Controllers\Dashboard\CourseController;
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

Route::middleware('auth')->group(function (): void {

    Route::group(['middleware' => ['auth', 'verified']], function (): void {
        Route::controller(ProfileController::class)
            ->prefix('profile')
            ->name('profile.')
            ->group(function (): void {
                Route::get('/{user}', 'show')->name('user.profile');
                route::post('/', 'passwordUpdate')->name('user.passwordUpdate');
            });
    });
    Route::controller(CourseController::class)->group(function (): void {
        Route::get('/courses', 'index')->name('courses');
        Route::post('/courses/register', 'register')->name('courses.register');
        Route::get('/courses/manage', 'manage')->name('courses.manage');
        Route::get('/courses/registration', 'registration')->name('courses.registration');
        Route::get('/courses/proctors', 'proctors')->name('courses.proctors');
        Route::get('/courses/howto', 'howTo')->name('courses.howto');

        // web.php
        Route::get('/assign/proctorForm/{id}', 'createAssignProctorForm')->name('show.assign.proctorForm');
        Route::post('/assign/proctorForm/{courseID}', 'storeAssignProctorForm')->name('assign.proctorForm');
        Route::get('/proctor-response', 'response')->name('proctor.response')->middleware('signed');

    });
    Route::inertia('/assign/proctorForm', 'ProctorDetailsForm');

    Route::get('/academic-progress', [AcademicProgressController::class, 'index'])
        ->name('academic.progress');
    Route::get('/achievements', [AchievementsController::class, 'index'])->name('achievements');
    Route::get('/campus', [CampusController::class, 'index'])->name('online-campus');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(PaymentController::class)->group(function (): void {
        Route::get('/payments', 'index')->name('payments');
    });

    //    Route::resource('payments', PaymentController::class)->only(['index', 'create', 'store']);
    Route::controller(StripeController::class)->group(function (): void {
        Route::get('/payments/pay', 'pay')->name('payments.pay');
        Route::get('/payments/make', 'create')->name('payments.make');
        Route::get('/payments/success/{paymentId}', 'paymentSuccess')->name('payments.success');
        Route::get('/payments/cancel/{paymentId}', 'paymentCancel')->name('payments.cancel');
    });

    Route::controller(StoryController::class)
        ->prefix('stories')
        ->name('stories.')
        ->group(function (): void {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/{story}/edit', 'create')->name('edit');
            Route::get('/{slug}', 'show')->name('show');
            Route::post('/', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

    Route::controller(StoryCommentController::class)->prefix('storyComment')->name('storyComment')->group(function (): void {
        Route::post('/{storyId}/comments', 'storeComment')->name('.store');
        Route::put('/{storyId}/comments/{commentId}', 'updateComment')->name('.update');
        Route::delete('/{storyId}/comments/{commentId}', 'destroyComment')->name('.destroy');
    });
    Route::get('/story/{storyId}/comments', [storyCommentController::class, 'index']);
    Route::get('/api/stories/{storyId}/comments', [storyCommentController::class, 'show']);

});

require __DIR__.'/auth.php';

require __DIR__.'/CampusCourse.php';
