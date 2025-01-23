<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class RouteMacroServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Route::macro('localized', function ($group) {
            $supportedLocales = config('app.supported_locales', 'en');

            // Language prefixed routes
            Route::group([
                'prefix' => '{locale?}',
                'where' => ['locale' => $supportedLocales],
                'defaults' => [
                    'locale' => function () {
                        // First try session
                        $sessionLocale = Session::get('locale');
                        if ($sessionLocale && in_array($sessionLocale, explode('|', config('app.supported_locales')))) {
                            return $sessionLocale;
                        }

                        // Fallback to app locale
                        return app()->getLocale();
                    }
                ]
            ], $group);
        });
    }
}
