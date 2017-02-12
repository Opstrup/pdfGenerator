<?php

namespace Tests\Unit;

use pdfgenerator\Util\PDFGenerator;
use Tests\TestCase;

class PDFGeneratorTest extends TestCase
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

    public function test_simple_dummy_test()
    {
        $UUT = new PDFGenerator();
        $this->assertEquals($UUT->test(), true);
    }
}
