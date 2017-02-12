<?php

namespace pdfgenerator\Providers;

use Illuminate\Support\ServiceProvider;
use pdfgenerator\Util\PDFGenerator;

class PDFGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('PDFGenerator', function() {
            return new PDFGenerator();
        });
    }
}
