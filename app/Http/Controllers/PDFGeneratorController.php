<?php

namespace pdfgenerator\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use pdfgenerator\Jobs\GenerateInvoice;

class PDFGeneratorController extends Controller
{
    public function dispatchGeneratorTask(Request $request)
    {
        // dispatch request to correct queue
        $data = $request->json()->all();

        if (sizeof($data) == 0)
        {
            Log::info('*-----------------------------------*');
            Log::info('|  ERROR! No data passed to service |');
            Log::info('*-----------------------------------*');
            return response('No data passed to service', 500);
        }

        Log::info('*-----------------------------------*');
        Log::info('| generating pdf task send to queue |');
        Log::info('*-----------------------------------*');

        $this->dispatch(new GenerateInvoice($data));
    }

    public function test()
    {
        Log::info('*-----------------------------------*');
        Log::info('| generating pdf task send to queue |');
        Log::info('*-----------------------------------*');

        $fakeData = 'Awesome';
        $this->dispatch(new GenerateInvoice($fakeData));
        return 'pdf created';
    }
}
