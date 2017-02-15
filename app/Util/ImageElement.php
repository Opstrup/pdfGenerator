<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;

class ImageElement extends Element
{
    private $_imgSrc;

    public function __construct($classes = [], $styles = [], $imgSrc)
    {
        parent::__construct($classes, $styles);
        $this->_imgSrc = $imgSrc;
    }

    public function toString()
    {
        return '<img class="' . parent::getClasses() . '" style="' . parent::getStyles() . '" src="' . $this->_imgSrc . '">';
    }
}