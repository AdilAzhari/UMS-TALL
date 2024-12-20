<?php

namespace App\Providers;

<<<<<<< HEAD
use App\Exceptions\CustomHandler;
use App\Models\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;
use PgSql\Connection;
use Schema;
=======
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        Schema::defaultStringLength(191);
        $this->configureModels();
        $this->configureCommands();
=======
        $this->configureModels();
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
        Vite::prefetch(concurrency: 3);
        // Optimize Eloquent
        Model::preventLazyLoading(! $this->app->isProduction());

        if (DB::connection() instanceof Connection) {
            DB::connection()->listen(function ($query) {
                // Log slow queries or complex queries
                if ($query->time > 100) {
                    Log::warning('Slow Query Detected', [
                        'sql' => $query->sql,
                        'bindings' => $query->bindings,
                        'time' => $query->time,
                    ]);
                }
            });
        }

        if ($this->app->isProduction()) {
            $this->app->bind(
                ExceptionHandler::class,
                CustomHandler::class
            );
        }
        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[0-9]{10}$/', $value);
        });

        // Configure queue failed job handling
        Queue::failing(function (JobFailed $event) {
            // Send notification on job failure
            Notification::send(
                User::where('is_admin', true)->get(),
                new JobFailedNotification($event->job)
            );
        });

    }

    private function configureModels(): void
    {
        Model::shouldBeStrict();
        Model::unguard();
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction()
        );
    }

    public function configureModels(): void
    {
        Model::shouldBeStrict();
        Model::unguard();
    }
}
