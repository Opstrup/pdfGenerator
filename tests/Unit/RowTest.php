<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use pdfgenerator\Util\Row;

class RowTest extends TestCase
{
    public function test_row_should_be_empty()
    {
        $UUT = new Row();
        $row = '<div class="row"></div>';
        $this->assertEquals($row, $UUT->toString());
    }
}
