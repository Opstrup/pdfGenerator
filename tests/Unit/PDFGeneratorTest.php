<?php

namespace Tests\Unit;

use pdfgenerator\PDFGenerator;
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

    public function test_default_pdflayout_size_should_be_1x1()
    {
        $UUT = new PDFGenerator(1, 1);
        $this->assertEquals(sizeof($UUT.getPdflayout()), 1);
    }
}
