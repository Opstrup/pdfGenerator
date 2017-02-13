<?php

namespace pdfgenerator\Util;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PDFGenerator
{
    public function generatePDFFromJSONData($JSONdata)
    {
        Log::info('*-------------------------------------------*');
        Log::info('|      Facade started on pdf generation     |');

        $snappy = App::make('snappy.pdf');
        $path = __DIR__ . '/../../temp/';
        $fileName = time() . '.pdf';
        $snappy->generateFromHtml('<div class="container">' .
            '<div class="row">' .
            '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">' .
            '<h1>Hello</h1>' .
            '</div>' .
            '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">' .
            '<h3>' . $JSONdata . '</h3>' .
            '</div>' .
            '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">' .
            '<h3>Goodbye</h3>' .
            '</div>' .
            '</div>' .
            '</div>', $path . $fileName);
    }

    public function test()
    {
        return true;
    }
}