<?php

namespace pdfgenerator\Util;


class Element
{
    private $_classes;

    /*
     * TODO:
     * Add functionality for adding style to an element
     * Add different elements (span, img, h1, h2, h3, lines..)
     * Add functionality for setting content of element
     */

    function __construct($classes)
    {
        $this->_classes = $this->unwrapArray($classes);
    }

    public function toString()
    {
        return '<div class="' . $this->_classes . '"></div>';
    }

    private function unwrapArray($array)
    {
        $unwrappedArray = array_pop($array);

        foreach ($array as $item)
        {
            $unwrappedArray .= " " . $item;
        }

        return $unwrappedArray;
    }
}