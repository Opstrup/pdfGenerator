<?php

namespace pdfgenerator\Util;


class Element
{
    private $_classes;

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