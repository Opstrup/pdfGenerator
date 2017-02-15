<?php

namespace pdfgenerator\Util;


class Element
{
    private $_classes;
    private $_styles;

    /*
     * TODO:
     * Add different elements (span, img, h1, h2, h3, lines..)
     * Add functionality for setting content of element
     */

    function __construct($classes = [], $styles = [])
    {
        $this->_classes = $this->unwrapArray($classes);
        $this->_styles = $this->unwrapArray(array_map(function($styles´){ return $styles´ . ";" ;}, $styles));
    }

    public function toString()
    {
        return '<div class="' . $this->_classes . '" style="' . $this->_styles . '"></div>';
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