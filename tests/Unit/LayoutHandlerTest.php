<?php

namespace Tests\Unit;

use Tests\TestCase;
use pdfgenerator\Util\LayoutHandler;
use pdfgenerator\Util\Element;

class LayoutHandlerTest extends TestCase
{
    public function test_get_layout_should_create_empty_layout()
    {
        $UUT = new LayoutHandler();
        $pdfSkeleton = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' .
            '<div class="container">' .
            '</div>';
        $this->assertEquals($UUT->getLayout(), $pdfSkeleton);
    }

    public function test_added_element_should_be_in_layout()
    {
        $UUT = new LayoutHandler();
        $element = $this->createMock(Element::class);
        $element->method('toString')
                ->willReturn('<p>Hello</p>');
        $UUT->addElement($element);

        $layout = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' .
            '<div class="container">' .
            '<p>Hello</p>' .
            '</div>';
        $this->assertEquals($UUT->getLayout(), $layout);
    }

    public function test_two_elements_should_be_in_layout()
    {
        $UUT = new LayoutHandler();
        $element = $this->createMock(Element::class);
        $element->method('toString')
                ->willReturn('<p>Hello</p>');
        $UUT->addElement($element);
        $UUT->addElement($element);

        $layout = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' .
            '<div class="container">' .
            '<p>Hello</p>' .
            '<p>Hello</p>' .
            '</div>';
        $this->assertEquals($UUT->getLayout(), $layout);
    }
}
