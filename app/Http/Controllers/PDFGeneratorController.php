<?php

namespace pdfgenerator\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PDFGeneratorController extends Controller
{
    public function dispatchGeneratorTask(Response $response)
    {
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

    public function test(Response $response)
    {
        $snappy = App::make('snappy.pdf');
        $snappy->generateFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>', '/tmp/bill-123.pdf');
        return 'pdf created';
        /*return $response->message(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );*/
    }
}
