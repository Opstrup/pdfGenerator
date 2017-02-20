<?php

namespace Tests\Feature;

use Tests\TestCase;
use pdfgenerator\Util\PDFGenerator;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PDFGeneratorTest extends TestCase
{
    private $json = [];

    public function setUp()
    {
        if ( ! $this->app)
        {
            $this->refreshApplication();
        } else {
            $this->app->flush();
        }

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

    public function test_feature_should_create_blank_pdf_from_json_data()
    {
        $UUT = new PDFGenerator();
        $UUT->generatePDFFromJSONData($this->json);
    }
}
