<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;

class DivElement extends Element
{
    private $_content;

    public function __construct($classes = [], $styles = [], $content = "")
    {
        parent::__construct($classes, $styles);
        $this->_content = $content;
    }

    public function toString()
    {
        return '<div class="' . parent::getClasses() . '" style="' . parent::getStyles() . '">' . $this->_content . '</div>';
    }
}