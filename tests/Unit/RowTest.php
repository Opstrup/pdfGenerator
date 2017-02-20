<?php

namespace Tests\Unit;

use Tests\TestCase;
use pdfgenerator\Util\Row;
use pdfgenerator\Util\Element;

class RowTest extends TestCase
{
    public function test_row_should_be_empty()
    {
        $UUT = new Row();
        $row = '<div class="row"></div>';
        $this->assertEquals($row, $UUT->toString());
    }

    public function test_row_should_contain_element()
    {
        $UUT = new Row();
        $element = $this->createMock(Element::class);
        $element->method('toString')
            ->willReturn('<p>Hello</p>');

        $UUT->addElementToRow($element);
        $row = '<div class="row"><p>Hello</p></div>';
        $this->assertEquals($row, $UUT->toString());
    }

    public function test_row_should_contain_two_elements()
    {
        $UUT = new Row();
        $element = $this->createMock(Element::class);
        $element->method('toString')
            ->willReturn('<p>Hello</p>');

        $UUT->addElementToRow($element);
        $UUT->addElementToRow($element);
        $row = '<div class="row"><p>Hello</p><p>Hello</p></div>';
        $this->assertEquals($row, $UUT->toString());
    }
}
