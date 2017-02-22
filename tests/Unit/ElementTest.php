<?php

namespace Tests\Unit;

use pdfgenerator\Util\LinesElement;
use PhpParser\Node\Expr\AssignOp\Div;
use Tests\TestCase;
use pdfgenerator\Util\Element;
use pdfgenerator\Util\ImageElement;
use pdfgenerator\Util\DivElement;
use pdfgenerator\Util\FooterElement;

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

    public function test_element_should_have_content()
    {
        $UUT = new DivElement([], [], "Hello");
        $element = '<div class="" style="">Hello</div>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_should_be_an_img_tag()
    {
        $imgSrc = "path-to-resource";
        $UUT = new ImageElement([""], [""], $imgSrc);
        $element = '<img class="" style=";" src="path-to-resource">';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_should_be_an_img_tag_with_style()
    {
        $styles = ["pull-right"];
        $imgSrc = "path-to-resource";
        $UUT = new ImageElement([""], $styles, $imgSrc);
        $element = '<img class="" style="pull-right;" src="path-to-resource">';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_should_be_an_img_tag_with_styles_and_classes()
    {
        $styles = ["background-color: #0d3625", "align-items: center"];
        $classes = ["col-md-1"];
        $imgSrc = "path-to-resource";
        $UUT = new ImageElement($classes, $styles, $imgSrc);
        $element = '<img class="col-md-1" style="align-items: center; background-color: #0d3625;" src="path-to-resource">';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_should_be_an_footer_tag()
    {
        $UUT = new FooterElement([""], [""]);
        $element = '<footer id="footer" class="" style=";"></footer>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_footer_should_have_correct_class()
    {
        $styles = ["background-color: #0d3625", "align-items: center"];
        $classes = ["col-md-1"];
        $UUT = new FooterElement($classes, $styles);

        $element = '<footer id="footer" class="col-md-1" style="align-items: center; background-color: #0d3625;"></footer>';
        $this->assertEquals($element, $UUT->toString());
    }

    public function test_element_footer_should_have_content()
    {
        $styles = ["background-color: #0d3625", "align-items: center"];
        $classes = ["col-md-1"];
        $content = "This is the content";
        $UUT = new FooterElement($classes, $styles, $content);

        $element = '<footer id="footer" class="col-md-1" style="align-items: center; background-color: #0d3625;">This is the content</footer>';
        $this->assertEquals($element, $UUT->toString());
    }
}
