<?php

namespace pdfgenerator;

use Illuminate\Support\Facades\App;

class PDFGenerator
{
    private $pdflayout = [];

    public function __construct($rows = 1, $columns = 1)
    {
        for ($i = 0; $i < $rows; $i++)
        {
            $this->pdflayout[] = [];
        }
    }

    public function generatePDF(): void
    {
        $snappy = App::make('snappy.pdf');
        $path = __DIR__ . '../../../temp/';
        $fileName = time() . '.pdf';
        $snappy->generateFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>', $path . $fileName);
    }

    /**
     * @return array
     */
    function getPdflayout(): array
    {
        return $this->pdflayout;
    }
}