<?php

namespace Tests\Unit;

use pdfgenerator\Util\LinesElement;
use Tests\TestCase;

class LinesElementTest extends TestCase
{
    public function test_element_should_be_empty_table()
    {
        $UUT = new LinesElement([""], [""], "", "");
        $element = '<table class="table " style=";"> </table>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_should_be_empty_tableBordered()
    {
        $classes = ["table-bordered"];
        $UUT = new LinesElement($classes, [""], "", "");
        $element = '<table class="table table-bordered" style=";"> </table>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_should_create_table_with_data()
    {
        $data =
        $UUT = new LinesElement([""], [""], "", "");
        $element = '<table class="table table-bordered" style=";"> </table>';
        $this->assertEquals($element, $UUT->toString());
    }
}
