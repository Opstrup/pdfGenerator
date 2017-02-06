<?php

namespace pdfgenerator\Http\Controllers;

use Illuminate\Http\Request;

class PDFGeneratorController extends Controller
{
    public function dispatchGeneratorTask(Request $request)
    {
        return $request->input( 'name' );
    }
}
