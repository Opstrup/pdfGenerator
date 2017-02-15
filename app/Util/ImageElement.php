<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;

class ImageElement extends Element
{

    /*
     * TODO:
     * Add different elements (span, img, h1, h2, h3, lines..)
     * Add functionality for setting content of element
     */

    public function toString()
    {
        return '<img class="' . parent::getClasses() . '" style="' . parent::getStyles() . '">';
    }
}