<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;

class LinesElement extends Element
{
    public function toString()
    {
        return '<table class="table' . parent::getClasses() . '" style="' . parent::getStyles() . '"> </table>';
    }
}