<?php

namespace Tests\Unit;

use pdfgenerator\Util\LinesElement;
use Tests\TestCase;

class LinesElementTest extends TestCase
{
    public function test_lines_should_be_empty_table()
    {
        $UUT = new LinesElement([""], [""], [""], [], "");
        $element = '<div class=""><table class="table " style=";"><tr></tr></table></div>';
        $this->assertEquals($element, $UUT->toString());
    }
    public function test_lines_should_be_empty_tableBordered()
    {
        $classes = ["table-bordered"];
        $UUT = new LinesElement($classes, [""], [""], [], "");
        $element = '<div class=""><table class="table table-bordered" style=";"><tr></tr></table></div>';
        $this->assertEquals($element, $UUT->toString());
    }
    public function test_lines_should_create_table_with_data()
    {
        $config = ["numberOfLines" => 3];
        $data = [["article number" => 132, "name" => "Sko", "discount" => 0, "price" => 300],
                 ["article number" => 3210, "name" => "Bukser", "discount" => 20, "price" => 100],
                 ["article number" => 7890, "name" => "T-shirt", "discount" => 50, "price" => 350]];
        $UUT = new LinesElement([""], [""], [""], $data, $config);
        $element = '<div class=""><table class="table " style=";">' .
                '<tr>' .
                    '<th>article number</th>' .
                    '<th>name</th>' .
                    '<th>discount</th>' .
                    '<th>price</th>' .
                '</tr>' .
                '<tr>' .
                    '<td>132</td>' .
                    '<td>Sko</td>' .
                    '<td>0</td>' .
                    '<td>300</td>' .
                '</tr>' .
                '<tr>' .
                    '<td>3210</td>' .
                    '<td>Bukser</td>' .
                    '<td>20</td>' .
                    '<td>100</td>' .
                '</tr>' .
                '<tr>' .
                    '<td>7890</td>' .
                    '<td>T-shirt</td>' .
                    '<td>50</td>' .
                    '<td>350</td>' .
                '</tr>' .
            '</table></div>';
        $this->assertEquals($element, $UUT->toString());
    }
    public function test_lines_wrapping_div_should_have_correct_class()
    {
        $UUT = new LinesElement([""], ["col-md-5"], [""], [], "");
        $element = '<div class="col-md-5"><table class="table " style=";"><tr></tr></table></div>';
        $this->assertEquals($element, $UUT->toString());
    }
    public function test_lines_should_have_correct_num_of_lines()
    {
        $data = [["article number" => 132, "name" => "Sko", "discount" => 0, "price" => 300],
            ["article number" => 3210, "name" => "Bukser", "discount" => 20, "price" => 100],
            ["article number" => 7890, "name" => "T-shirt", "discount" => 50, "price" => 350]];
        $config = ["numberOfLines" => 2];
        $UUT = new LinesElement([""], [""], [""], $data, $config);
        $element = '<div class=""><table class="table " style=";">' .
            '<tr>' .
            '<th>article number</th>' .
            '<th>name</th>' .
            '<th>discount</th>' .
            '<th>price</th>' .
            '</tr>' .
            '<tr>' .
            '<td>132</td>' .
            '<td>Sko</td>' .
            '<td>0</td>' .
            '<td>300</td>' .
            '</tr>' .
            '<tr>' .
            '<td>3210</td>' .
            '<td>Bukser</td>' .
            '<td>20</td>' .
            '<td>100</td>' .
            '</tr>' .
            '</table></div>';
        $this->assertEquals($element, $UUT->toString());
    }
}
