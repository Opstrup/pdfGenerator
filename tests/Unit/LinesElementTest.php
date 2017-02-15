<?php

namespace Tests\Unit;

use pdfgenerator\Util\LinesElement;
use Tests\TestCase;

class LinesElementTest extends TestCase
{
    public function test_element_should_be_empty_table()
    {
        $UUT = new LinesElement([""], [""], "", "");
        $element = '<table class="table " style=";"><tr><th></th></tr><tr><td></td></tr></table>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_should_be_empty_tableBordered()
    {
        $classes = ["table-bordered"];
        $UUT = new LinesElement($classes, [""], "", "");
        $element = '<table class="table table-bordered" style=";"><tr><th></th></tr><tr><td></td></tr></table>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_should_create_table_with_data()
    {
        $UUT = new LinesElement([""], [""], "", "");
        $element = '<table class="table " style=";">' .
                '<tr>' .
                    '<th>article number</th>' .
                    '<th>name</th>' .
                    '<th>discount</th>' .
                    '<th>price</th>' .
                '</tr>' .
                '<tr>' .
                    '<td>0132</td>' .
                    '<td>Sko</td>' .
                    '<td>0</td>' .
                    '<td>300</td>' .
                '</tr>' .
                '<tr>' .
                    '<td>3210number</td>' .
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
            '</table>';
        $this->assertEquals($element, $UUT->toString());
    }
}
