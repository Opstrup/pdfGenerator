<?php

namespace pdfgenerator\Util;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use pdfgenerator\Util\LayoutHandler;

class PDFGenerator
{
    private $_stylesheets = ["PDFStyles"];
    private $_layoutHandler = null;

    public function generatePDFFromJSONData($JSONdata)
    {
        Log::info('*-------------------------------------------*');
        Log::info('|       Facade pdf generation started       |');
        $this->_layoutHandler = new LayoutHandler($this->_stylesheets);
        $snappy = App::make('snappy.pdf');
        $path = __DIR__ . '/../../temp/';
        $fileName = time() . '.pdf';

        // Create new elements here


        $snappy->generateFromHtml($this->_layoutHandler->getLayout(), $path . $fileName);
    }

    public function test()
    {
        $snappy = App::make('snappy.pdf');
        $path = __DIR__ . '/../../temp/';
        $fileName = time() . '.pdf';
        $tableBody = "";

        $snappy->generateFromHtml('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' .
            '<link rel="stylesheet" type="text/css" href="' . public_path("/css/PDFStyles.css") . '" >' .
            '<div class="container">' .
            '<div class="col-xs-3 pull-right">' .
            '<h1>Hello</h1>' .
            '</div>' .
            '<table class="table table-condensed">' .
            '<tr>' .
            '<th>article number</th>' .
            '<th>name</th>' .
            '<th>discount</th>' .
            '<th>price</th>' .
            '</tr>' .
            $tableBody .
            '</table>' .
            '<footer class="page-break">' .
            '<h3>' .
            'Footer Text goes here' .
            '</h3>' .
            '</footer>' .
            '<h1>Test with page break</h1>' .
            '</div>', $path . $fileName);
    }
}