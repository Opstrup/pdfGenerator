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
        $UUT->generatePDFFromJSONData($this->json, "-blank");
    }

    public function test_feature_should_create_pdf_with_logo_from_json_data()
    {
        $this->json["layout"]["firstpage"] = [
            "row1" => [
                "col1" => ["element" => [
                    "type" => "image",
                    "src" => "http://freesoft.dk/images/pics/freesoft-logo.png",
                    "class" => [],
                    "style" => []
                    ]
                ],
                "col2" => ["element" => ["type" => "", "class" => [], "style" => [],]], "col3" => ["element" => ["type" => "", "class" => [], "style" => []]]]];

        $UUT = new PDFGenerator();
        $UUT->generatePDFFromJSONData($this->json, "-only_logo");
    }

    public function test_feature_should_create_pdf_with_logo_with_correct_class_from_json_data()
    {
        $this->json["layout"]["firstpage"] = [
            "row1" => [
                "col1" => ["element" => [
                    "type" => "image",
                    "src" => "http://freesoft.dk/images/pics/freesoft-logo.png",
                    "class" => ["col-xs-6", "pull-right"],
                    "style" => [],
                ]
                ],
                "col2" => ["element" => ["type" => "", "class" => [], "style" => []]], "col3" => ["element" => ["type" => "", "class" => [], "style" => []]]]];

        $UUT = new PDFGenerator();
        $UUT->generatePDFFromJSONData($this->json, "-logo_correct_class");
    }

    public function test_feature_should_create_pdf_with_logo_and_text_from_json_data()
    {
        $this->json["layout"]["firstpage"] = [
            "row1" => [
                "col1" => ["element" => [
                    "type" => "image",
                    "src" => "http://freesoft.dk/images/pics/freesoft-logo.png",
                    "class" => ["col-xs-6"],
                    "style" => [],
                ]
                ],
                "col2" => ["element" => [
                    "type" => "div",
                    "class" => ["col-xs-3"],
                    "style" => [],
                    "content" => "Hello world",
                ]
                ], "col3" => ["element" => ["type" => "", "class" => [], "style" => []]]]];
        $UUT = new PDFGenerator();
        $UUT->generatePDFFromJSONData($this->json, "-logo+text");
    }
}
