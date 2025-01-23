<?php

namespace App\Providers;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Override the __ helper
        Lang::macro('get', function ($key, array $replace = [], $locale = null) {
            $locale = $locale ?: app()->getLocale();

            // Get the original translation
            $translation = trans($key, $replace, $locale);

            // Add your custom logic here
            // For example, adding a prefix or suffix:
            // return "★ {$translation}";

            // Or you could add different modifications based on the locale:
            return $locale === 'fr' ? "🇫🇷 {$translation}" : "djkalsjdlkjaslkdjalksjdkljsadkljsaldkj {$translation}";
        });
    }
}
