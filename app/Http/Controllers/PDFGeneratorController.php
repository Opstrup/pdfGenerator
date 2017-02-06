<?php

namespace pdfgenerator\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\App;

class PDFGeneratorController extends Controller
{
    public function dispatchGeneratorTask(Response $response)
    {
        // dispatch request to correct queue
        $snappy = App::make('snappy.pdf');
        $html = '<h1>Bill</h1><p>You owe me money, dude.</p>';
        return $response->message(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
    }

    public function test()
    {
        $snappy = App::make('snappy.pdf');
        $path = __DIR__ . '../../../../temp/';
        $fileName = time() . '.pdf';
        $snappy->generateFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>', $path . $fileName);
        return 'pdf created';
    }
}
