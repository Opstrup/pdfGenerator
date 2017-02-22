<?php

namespace Tests\Unit;

use Tests\TestCase;
use pdfgenerator\Util\LayoutHandler;
use pdfgenerator\Util\Element;
use pdfgenerator\Util\Row;

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

    public function test_layout_should_have_empty_row()
    {
        $UUT = new LayoutHandler();
        $UUT->addRow(new Row());
        $pdfSkeleton = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' .
            '<div class="container">' .
                '<div class="row"></div>' .
            '</div>';
        $this->assertEquals($UUT->getLayout(), $pdfSkeleton);
    }

    public function test_row_with_element_should_be_in_layout()
    {
        $UUT = new LayoutHandler();
        $row = $this->createMock(Row::class);
        $row->method('toString')
            ->willReturn('<div class="row"><p>Hello</p></div>');

        $UUT->addRow($row);

        $layout = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' .
            '<div class="container">' .
                '<div class="row">' .
                    '<p>Hello</p>' .
                '</div>' .
            '</div>';
        $this->assertEquals($UUT->getLayout(), $layout);
    }

    public function test_two_rows_with_elements_should_be_in_layout()
    {
        $UUT = new LayoutHandler();
        $row = $this->createMock(Row::class);
        $row->method('toString')
            ->willReturn('<div class="row"><p>Hello</p></div>');

        $UUT->addRow($row);
        $UUT->addRow($row);

        $layout = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' .
            '<div class="container">' .
                '<div class="row">' .
                    '<p>Hello</p>' .
                '</div>' .
                '<div class="row">' .
                    '<p>Hello</p>' .
                '</div>' .
            '</div>';
        $this->assertEquals($UUT->getLayout(), $layout);
    }

    public function test_should_add_custom_stylesheet()
    {
        $stylesheet = ['PDFStyles'];
        $UUT = new LayoutHandler($stylesheet);
        $pdfSkeleton = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' .
            '<link rel="stylesheet" type="text/css" href="' . public_path("/css/PDFStyles.css") . '" >' .
            '<div class="container">' .
            '</div>';
        $this->assertEquals($UUT->getLayout(), $pdfSkeleton);
    }

    public function test_should_add_custom_js()
    {
        $stylesheet = ['PDFStyles'];
        $js = ['PDFStyleHelper'];
        $UUT = new LayoutHandler($stylesheet, $js);
        $pdfSkeleton = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' .
            '<link rel="stylesheet" type="text/css" href="' . public_path("/css/PDFStyles.css") . '" >' .
            '<div class="container">' .
            '</div>' .
            '<script src="' . public_path("/js/PDFStyleHelper.js") . '" ></script>';
        $this->assertEquals($UUT->getLayout(), $pdfSkeleton);
    }
}
