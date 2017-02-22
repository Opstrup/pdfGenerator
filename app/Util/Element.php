<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Helper;

abstract  class Element
{
    private $_classes;
    private $_styles;
    private $_helper;

    function __construct($classes, $styles)
    {
        $this->_helper = New Helper();
        $this->_classes = $this->_helper->unwrapArray($classes);
        $this->_styles = $this->_helper->unwrapArray(array_map(function($styles´){ return $styles´ . ";" ;}, $styles));
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
}