<?php

namespace App\Providers;

use App\Models\Student;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ignoring default routes defined by passport internally
        Passport::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // only hashed client secrets will be stored in database
        Passport::hashClientSecrets();

        // passport tokens expire in 15 days
        Passport::tokensExpireIn(now()->addDays(15));

        // Globally set $guarded variable to an empty array
        Model::isUnguarded();

        // Rate limiting chat APIs
        RateLimiter::for('casual-chat', function (Request $request) {
            /** @var Student $student */
            $student = $request->user();

            return Limit::perDay(
                (int)config('chat.casual.throttle')
            )
                ->by($student->id)
                ->response(function (Request $request, array $headers) {
                    return response()->json([
                        'message' => 'throttle_err',
                        'status' => 429
                    ], 200, $headers);
                });
        });

        RateLimiter::for('quiz-chat', function (Request $request) {
            /** @var Student $student */
            $student = $request->user();

            return Limit::perDay(
                (int)config('chat.quiz.throttle')
            )
                ->by($student->id)
                ->response(function (Request $request, array $headers) {
                    return response()->json([
                        'message' => 'throttle_err',
                        'status' => 429
                    ], 200, $headers);
                });
        });
    }
}
