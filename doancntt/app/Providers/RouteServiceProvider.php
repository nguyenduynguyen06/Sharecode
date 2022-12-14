<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            # Site
            Route::middleware('web')->prefix('/')->name('site.')->group(function () {
                #home
                Route::namespace($this->namespace)
                    ->group(base_path('routes/web/site/index.php'));

                #parentCategory
                Route::prefix('/{parentCategorySlug}.html')->name('parentCategory.')->group(function () {
                    Route::namespace($this->namespace)
                        ->group(base_path('routes/web/site/parentCategory.php'));
                });

                #product
                Route::prefix('/san-pham')->name('product.')->group(function () {
                    Route::namespace($this->namespace)
                        ->group(base_path('routes/web/site/product.php'));
                });

                #subCategory
                Route::prefix('/{parentCategorySlug}')->name('subCategory.')->group(function () {
                    Route::namespace($this->namespace)
                        ->group(base_path('routes/web/site/subCategory.php'));
                });
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}