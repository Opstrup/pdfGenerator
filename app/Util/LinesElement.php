<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;

class LinesElement extends Element
{
    private $_tableHeaderElements;
    private $_tableRowElements;

    public function __construct($classes = [], $styles = [], $data, $lineConfigSettings)
    {
        parent::__construct($classes, $styles);
        $this->prepareData($data, $lineConfigSettings);
    }

    public function toString()
    {
        return '<table class="table ' . parent::getClasses() . '" style="' . parent::getStyles() . '">' .
            '<tr>' .
                $this->_tableHeaderElements .
            '</tr>' .
            $this->_tableRowElements .
            '</table>';
    }

    private function prepareData($data, $lineConfigSettings)
    {
        if (sizeof($data) > 0)
        {
            foreach (array_keys($data[0]) as $headerElement)
            {
                $this->_tableHeaderElements .= '<th>' . $headerElement . '</th>';
            }

            foreach ($data as $tableRow)
            {
                $this->_tableRowElements .= '<tr>';
                foreach ($tableRow as $value)
                {
                    $this->_tableRowElements .= '<td>' . $value . '</td>';
                }
                $this->_tableRowElements .= '</tr>';
            }
        }
    }
}