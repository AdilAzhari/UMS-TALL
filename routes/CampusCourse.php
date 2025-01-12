<?php

use App\Http\Controllers\Campus\AnnouncementController;
use App\Http\Controllers\Campus\AssignmentController;
use App\Http\Controllers\Campus\CampusController;
use App\Http\Controllers\Campus\ForumDiscussionController;
use App\Http\Controllers\Campus\LearningGuideController;
use App\Http\Controllers\Campus\QuizController;
use Illuminate\Support\Facades\Route;

Route::name('campus.')
    ->prefix('campus/')
    ->group(function () {
        Route::controller(CampusController::class)->group(function () {
            Route::get('/course/{id}', 'course')->name('course.show');
            Route::get('/course/{courseId}/syllabus', 'syllabus')->name('syllabus');
            Route::get('/course/{courseId}/resources', 'resources')->name('resources');
            Route::post('/course/{id}/announcements', 'storeAnnouncement')->name('course.announcements.store');
        });
        //Announcement Routes
        Route::controller(AnnouncementController::class)
            ->prefix('course/{id}/announcements')
            ->name('course.announcements.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{announcementId}', 'show')->name('show');
            });
        Route::prefix('/courses/{courseId}/weeks/{weekId}')
            ->name('courses.weeks.')
            ->group(function () {
                // Learning Guide Routes
                Route::controller(LearningGuideController::class)
                    ->prefix('/guides')
                    ->name('guides.')
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/week', 'show')->name('weekGuide');
                    });

                // Forum Discussion Routes
                Route::controller(ForumDiscussionController::class)
                    ->prefix('discussions')
                    ->name('discussions.')->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/comment', 'storeComment')->name('store.create');
                        Route::post('/{discussion}/replies', 'storeReply')->name('replies.store');
                    });

                // Quiz Routes
                Route::controller(QuizController::class)
                    ->prefix('quizzes')
                    ->name('quiz.')
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/{quizId}', 'show')->name('show');
                        Route::post('/{quizId}/submit', 'submit')->name('submit');
                        Route::get('/{quizId}/results', 'results')->name('results');
                    });

                // Assignment Routes
                Route::controller(AssignmentController::class)->prefix('assignments')->name('assignments.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{assignment}', 'show')->name('show');
                    Route::post('/{assignment}/submit', 'submit')->name('submit');
                    Route::get('/{assignment}/feedback', 'feedback')->name('feedback');
                });
            });
    });
