<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;

class LayoutHandler
{
    private $_layoutStyle;
    private $_openingContainer = '<div class="container">';
    private $_closingContainer = '</div>';
    private $_body = array();

    /*
     * TODO:
     * Add calculation for pages
     * Add intelligent page break
     */

    function __construct($styleSheets = [])
    {
        $styles = '';
        foreach ($styleSheets as $sheet)
        {
            $styles .= '<link rel="stylesheet" type="text/css" href="' . public_path("/css/" . $sheet . ".css") . '" >';
        }
        $this->_layoutStyle = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">'
            . $styles;
    }

    public function addRow(Row $row)
    {
        $this->_body[] = $row->toString();
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