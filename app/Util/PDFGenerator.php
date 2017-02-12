<?php

namespace pdfgenerator\Util;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PDFGenerator
{
    public function generatePDFFromJSONData($JSONdata)
    {
        Log::info('Facade started on pdf generation');
        $snappy = App::make('snappy.pdf');
        $path = __DIR__ . '/../../temp/';
        $fileName = time() . '.pdf';
        $snappy->generateFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p><p>' . $JSONdata . '</p>', $path . $fileName);
    }

    public function test()
    {
        return true;
    }
}