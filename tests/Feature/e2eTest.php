<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class e2eTest extends TestCase
{

    public function test_e2e_welcome()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_e2e_no_data_exception()
    {
        $response = $this->call('POST', 'api/pdfdocument');
        $response->assertStatus(500)->withException(new \Exception('No data passed to service'));
    }

    public function test_e2e_create_simple_pdf()
    {
        $data = [
                "data" => ["lines" => [
                    ["article number" => 132, "name" => "Sko", "discount" => 0, "price" => 300],
                    ["article number" => 3210, "name" => "Bukser", "discount" => 20, "price" => 100],
                    ["article number" => 7890, "name" => "T-shirt", "discount" => 50, "price" => 350]]],
                "layout" => ["firstpage" => [
                    "row1" => [
                        "col1" => ["element" => [
                            "type" => "lines",
                            "class" => ["col-xs-6"],
                            "table-class" => ["table-striped"],
                            "style" => [],
                            "config" => ["numberOfLines" => 3]
                        ]],
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
                    ]
                ]],
                "config" => [],
                "type" => "invoice"
                ];

        $response = $this->json('POST', 'api/pdfdocument', $data);
        $response->assertStatus(200);
    }
}
