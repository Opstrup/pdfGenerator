<?php

namespace pdfgenerator\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;
use pdfgenerator\Jobs\GenerateInvoice;

class PDFGeneratorController extends Controller
{
    public function dispatchGeneratorTask(Response $response)
    {
        // dispatch request to correct queue

    }

    public function test()
    {
        Log::info('generating pdf task send to queue');
        $this->dispatch(new GenerateInvoice());
        Log::info('pdf task is now done');
        return 'pdf created';
    }
}
