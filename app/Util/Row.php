<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;

class Row
{
    private $_elements = array();

    public function addElementToRow(Element $element)
    {
        $this->_elements[] = $element;
    }

    public function toString()
    {
        return '<div class="row">' . $this->deconstructElements() . '</div>';
    }

    private function deconstructElements()
    {
        $elementsString = '';
        foreach ($this->_elements as $element)
        {
            $elementsString .= $element->toString();
        }
        return $elementsString;
    }

}