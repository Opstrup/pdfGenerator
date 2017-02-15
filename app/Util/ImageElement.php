<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;

class ImageElement extends Element
{
    public function toString()
    {
        return '<img class="' . parent::getClasses() . '" style="' . parent::getStyles() . '">';
    }
}