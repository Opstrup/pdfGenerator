<?php

namespace Tests\Unit;

use Tests\TestCase;
use pdfgenerator\Util\LayoutHandler;

class LayoutHandlerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_get_layout_should_create_empty_layout()
    {
        $UUT = new LayoutHandler();
        $pdfSkeleton = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' .
            '<div class="container">' .
            '</div>';
        $this->assertEquals($UUT->getLayout(), $pdfSkeleton);
    }
}
