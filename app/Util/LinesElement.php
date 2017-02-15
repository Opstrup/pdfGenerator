<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;

class LinesElement extends Element
{
    public function __construct($classes = [], $styles = [], $imgSrc)
    {
        parent::__construct($classes, $styles);
    }

    public function toString()
    {
        return '<table class="table' . parent::getClasses() . '" style="' . parent::getStyles() . '"> </table>';
    }
}