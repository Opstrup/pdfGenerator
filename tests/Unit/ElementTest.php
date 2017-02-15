<?php

namespace Tests\Unit;

use Tests\TestCase;
use pdfgenerator\Util\Element;
use pdfgenerator\Util\ImageElement;
use pdfgenerator\Util\DivElement;

class ElementTest extends TestCase
{
    public function test_element_should_be_initialized_with_correct_col()
    {
        $classes = ["col-md-1"];
        $UUT = new DivElement($classes, []);
        $element = '<div class="col-md-1" style=""></div>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_should_be_initialized_with_more_than_one_class()
    {
        $classes = ["col-md-1", "pull-right"];
        $UUT = new DivElement($classes, []);
        $element = '<div class="pull-right col-md-1" style=""></div>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_should_be_initialized_with_correct_styling()
    {
        $styles = ["background-color: #0d3625"];
        $classes = ["col-md-1", "pull-right"];
        $UUT = new DivElement($classes, $styles);
        $element = '<div class="pull-right col-md-1" style="background-color: #0d3625;"></div>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_should_be_initialized_with_more_than_one_styling()
    {
        $styles = ["background-color: #0d3625", "align-items: center"];
        $classes = ["col-md-1", "pull-right"];
        $UUT = new DivElement($classes, $styles);
        $element = '<div class="pull-right col-md-1" style="align-items: center; background-color: #0d3625;"></div>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_should_be_an_img_tag()
    {
        $styles = [""];
        $classes = [""];
        $UUT = new ImageElement($classes, $styles);
        $element = '<img class="" style=";">';
        $this->assertEquals($element, $UUT->toString());
    }
}
