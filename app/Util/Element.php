<?php

namespace pdfgenerator\Util;


abstract  class Element
{
    private $_classes;
    private $_styles;

    /*
     * TODO:
     * Add different elements (span, img, h1, h2, h3, lines..)
     * Add functionality for setting content of element
     */

    function __construct($classes, $styles)
    {
        $this->_classes = $this->unwrapArray($classes);
        $this->_styles = $this->unwrapArray(array_map(function($styles´){ return $styles´ . ";" ;}, $styles));
    }

    public function toString()
    {
        // Needs to be implemented in child classes
    }

    public function getClasses()
    {
        return $this->_classes;
    }

    public function getStyles()
    {
        return $this->_styles;
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