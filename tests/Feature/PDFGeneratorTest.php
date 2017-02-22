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
                "col2" => ["element" => ["type" => "div", "class" => [], "style" => [], "content" => ""]],
                "col3" => ["element" => ["type" => "div", "class" => [], "style" => [], "content" => ""]]]];

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
                "col2" => ["element" => ["type" => "div", "class" => [], "style" => [], "content" => ""]],
                "col3" => ["element" => ["type" => "div", "class" => [], "style" => [], "content" => ""]]]];

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
                ], "col3" => ["element" => ["type" => "div", "class" => [], "style" => [], "content" => ""]]]];
        $UUT = new PDFGenerator();
        $UUT->generatePDFFromJSONData($this->json, "-logo+text");
    }

    public function test_feature_should_create_pdf_with_two_rows()
    {
        $this->json["layout"]["firstpage"] = [
            "row1" => [
                "col1" => ["element" => ["type" => "image", "src" => "http://freesoft.dk/images/pics/freesoft-logo.png",
                    "class" => ["col-xs-6"],
                    "style" => []]],
                "col2" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [], "content" => ""]],
                "col3" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [], "content" => ""]]],
            "row2" => [
                "col1" => ["element" => [
                    "type" => "div",
                    "class" => ["col-xs-12"],
                    "style" => [],
                    "content" => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem" .
                        " accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae " .
                        "ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt" .
                        " explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut" .
                        " odit aut fugit, sed quia consequuntur magni dolores eos qui ratione" .
                        " voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum" .
                        " quia dolor sit amet, consectetur,"
                ]
                ],
                "col2" => ["element" => ["type" => "div", "class" => [], "style" => [], "content" => ""]],
                "col3" => ["element" => ["type" => "div", "class" => [], "style" => [], "content" => ""]]
            ]];
        $UUT = new PDFGenerator();
        $UUT->generatePDFFromJSONData($this->json, "-logo+text_on_second_row");
    }

    public function test_feature_should_create_pdf_with_two_rows_with_correct_class()
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
                "col2" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [], "content" => "1"]],
                "col3" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [], "content" => "2"]]],
            "row2" => [
                "col1" => ["element" => [
                    "type" => "div",
                    "class" => ["col-xs-4", "text-justify"],
                    "style" => [],
                    "content" => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem" .
                        " accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae " .
                        "ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt" .
                        " explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut" .
                        " odit aut fugit, sed quia consequuntur magni dolores eos qui ratione" .
                        " voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum" .
                        " quia dolor sit amet, consectetur,"
                ]
                ],
                "col2" => ["element" => ["type" => "div", "class" => ["col-xs-4"], "style" => [], "content" => ""]],
                "col3" => ["element" => ["type" => "div", "class" => ["col-xs-4"], "style" => [], "content" => ""]]
            ]];
        $UUT = new PDFGenerator();
        $UUT->generatePDFFromJSONData($this->json, "-logo+text_on_second_row_text-justify");
    }

    public function test_feature_should_create_pdf_with_lines()
    {
        $this->json["data"]["lines"] = [
            ["article number" => 132, "name" => "Sko", "discount" => 0, "price" => 300],
            ["article number" => 3210, "name" => "Bukser", "discount" => 20, "price" => 100],
            ["article number" => 7890, "name" => "T-shirt", "discount" => 50, "price" => 350]
        ];
        $this->json["layout"]["firstpage"] = [
            "row1" => [
                "col1" => ["element" => [
                    "type" => "lines",
                    "class" => ["col-xs-6"],
                    "table-class" => ["table-striped"],
                    "style" => [],
                    "config" => ["numberOfLines" => 2]
                ]
                ],
                "col2" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [], "content" => ""]],
                "col3" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [],"content" => "" ]]]];
        $UUT = new PDFGenerator();
        $UUT->generatePDFFromJSONData($this->json, "-lines");
    }

    public function test_feature_should_create_pdf_with_footer_element()
    {
        $this->json["data"]["lines"] = [
            ["article number" => 132, "name" => "Sko", "discount" => 0, "price" => 300],
            ["article number" => 3210, "name" => "Bukser", "discount" => 20, "price" => 100],
            ["article number" => 7890, "name" => "T-shirt", "discount" => 50, "price" => 350]
        ];
        $this->json["layout"]["firstpage"] = [
            "row1" => [
                "col1" => ["element" => [
                    "type" => "lines",
                    "class" => ["col-xs-6"],
                    "table-class" => ["table-striped"],
                    "style" => [],
                    "config" => ["numberOfLines" => 3]
                ]
                ],
                "col2" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [], "content" => ""]],
                "col3" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [],"content" => "" ]]],
            "row2" => [
                "col1" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [], "content" => ""]],
                "col2" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [], "content" => ""]],
                "col3" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [],"content" => "" ]]
            ],
            "row3" => [
                "col1" => ["element" => ["type" => "footer", "class" => ["col-xs-4 col-xs-offset-4"], "style" => [], "content" => "This is the footer!"]],
                "col2" => ["element" => ["type" => "div", "class" => [""], "style" => [], "content" => ""]],
                "col3" => ["element" => ["type" => "div", "class" => [""], "style" => [],"content" => "" ]]
            ],
            "row4" => [
                "col1" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [], "content" => ""]],
                "col2" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [], "content" => "<h1>This is second page</h1>"]],
                "col3" => ["element" => ["type" => "div", "class" => ["col-xs-3"], "style" => [],"content" => "" ]]
            ],
        ];
        $UUT = new PDFGenerator();
        $UUT->generatePDFFromJSONData($this->json, "-lines-with-footer");
    }
}
