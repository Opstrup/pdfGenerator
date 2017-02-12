<?php

namespace pdfgenerator\Facades;

class PDFGeneratorFacade extends \Illuminate\Support\Facades\Facade
{
    public static function getFacadeAccessor()
    {
        return 'PDFGenerator';
    }
}