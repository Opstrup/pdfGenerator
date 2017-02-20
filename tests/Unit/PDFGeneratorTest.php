<?php

namespace Tests\Unit;

use pdfgenerator\Util\PDFGenerator;
use Tests\TestCase;

class PDFGeneratorTest extends TestCase
{
    private $json = [];

    public function setUp()
    {
        $this->json = [
                    "data" => [
                        "lines" => []
                    ],
                    "config" => [],
                    "type" => "invoice",
                    "layout" => [
                        "firstpage" => [],
                        "secondpage" => [],
                        "thirdpage" => [],
                        "lastpage" => []
                    ]
        ];
    }
}
