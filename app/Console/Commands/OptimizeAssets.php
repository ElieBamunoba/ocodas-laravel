<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MatthiasMullie\Minify;

class OptimizeAssets extends Command
{
    protected $signature = 'optimize:assets';
    protected $description = 'Combine and minify CSS and JavaScript files';

    public function handle()
    {
        $this->info('Starting asset optimization...');

        // CSS Files to combine
        $cssFiles = [
            'css/bootstrap.min.css',
            'css/animate.css',
            'css/owl.carousel.css',
            'css/font-awesome.css',
            'css/themify-icons.css',
            'css/flaticon.css',
            'revolution/css/layers.css',
            'revolution/css/settings.css',
            'css/prettyPhoto.css',
            'css/shortcodes.css',
            'css/main.css',
            'css/responsive.css'
        ];

        // JavaScript Files to combine
        $jsFiles = [
            'js/jquery.easing.js',
            'js/jquery-waypoints.js',
            'js/jquery-validate.js',
            'js/owl.carousel.js',
            'js/jquery.prettyPhoto.js',
            'js/numinate.min6959.js',
            'js/main.js'
        ];

        // Combine and minify CSS
        $this->combineCSSFiles($cssFiles);

        // Combine and minify JavaScript
        $this->combineJSFiles($jsFiles);

        $this->info('Asset optimization completed!');
    }

    protected function combineCSSFiles($files)
    {
        $minifier = new Minify\CSS();

        foreach ($files as $file) {
            $filePath = public_path($file);
            if (file_exists($filePath)) {
                $minifier->add($filePath);
            } else {
                $this->warn("File not found: {$file}");
            }
        }

        // Create directory if it doesn't exist
        $outputDir = public_path('css/min');
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Save minified file
        $minifier->minify(public_path('css/combined.min.css'));
        $this->info('CSS files combined and minified successfully!');
    }

    protected function combineJSFiles($files)
    {
        $minifier = new Minify\JS();

        foreach ($files as $file) {
            $filePath = public_path($file);
            if (file_exists($filePath)) {
                $minifier->add($filePath);
            } else {
                $this->warn("File not found: {$file}");
            }
        }

        // Create directory if it doesn't exist
        $outputDir = public_path('js/min');
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Save minified file
        $minifier->minify(public_path('js/combined.min.js'));
        $this->info('JavaScript files combined and minified successfully!');
    }
}