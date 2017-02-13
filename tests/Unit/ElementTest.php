<?php

namespace Tests\Unit;

use Tests\TestCase;
use pdfgenerator\Util\Element;

class ElementTest extends TestCase
{
    public function test_element_should_be_initialized_with_correct_col()
    {
        $classes = ["col-md-1"];
        $UUT = new Element($classes);
        $element = '<div class="col-md-1"></div>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_should_be_initialized_with_more_than_one_class()
    {
        $classes = ["col-md-1", "pull-right"];
        $UUT = new Element($classes);
        $element = '<div class="pull-right col-md-1"></div>';
        $this->assertEquals($element, $UUT->toString());
    }
}
