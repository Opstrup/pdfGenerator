<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;

class DivElement extends Element
{
    public function toString()
    {
        return '<div class="' . parent::getClasses() . '" style="' . parent::getStyles() . '"></div>';
    }
}