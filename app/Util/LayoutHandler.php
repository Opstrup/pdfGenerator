<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;

class LayoutHandler
{
    private $_layoutStyle;
    private $_openingContainer = '<div class="container">';
    private $_closingContainer = '</div>';
    private $_body = array();

    function __construct()
    {
        // TODO: Add dynamic loading of stylesheets
        $this->_layoutStyle = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
    }

    public function addElement(Element $element)
    {
        $this->_body[] = $element->toString();
    }

    public function getLayout()
    {
        $body = '';
        foreach ($this->_body as $element)
        {
            $body .= $element;
        }

        return $this->_layoutStyle . $this->_openingContainer . $body . $this->_closingContainer;
    }
}