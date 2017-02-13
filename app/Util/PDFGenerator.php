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
        $snappy->generateFromHtml('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' .
            '<div class="container">' .
            '<div class="row">' .
            '<div class="col-xs-12">' .
            '<h1>Hello</h1>' .
            '</div>' .
            '<div class="col-xs-3 pull-left">' .
            '<h3>' . $JSONdata . '</h3>' .
            '</div>' .
            '<div class="col-xs-3 pull-right">' .
            '<h3>Goodbye</h3>' .
            '</div>' .
            '</div>' .
            '<button class="btn btn-default">Test</button>' .
            '</div>', $path . $fileName);
    }

    public function test()
    {
        return true;
    }
}