<?php

namespace pdfgenerator\Util;

use pdfgenerator\Util\Element;
use pdfgenerator\Util\Helper;

class LinesElement extends Element
{
    private $_tableHeaderElements;
    private $_tableRowElements;
    private $_wrappingClasses;
    private $_helper;

    public function __construct($tableClasses = [], $wrappingClasses = [], $styles = [], $data, $lineConfigSettings)
    {
        $this->_helper = New Helper();
        parent::__construct($tableClasses, $styles);
        $this->prepareData($data, $lineConfigSettings);
        $this->_wrappingClasses = $this->_helper->unwrapArray($wrappingClasses);
    }

    public function toString()
    {
        return '<div class="' . $this->_wrappingClasses . '"><table class="table ' . parent::getClasses() . '" style="' . parent::getStyles() . '">' .
            '<tr>' .
                $this->_tableHeaderElements .
            '</tr>' .
            $this->_tableRowElements .
            '</table></div>';
    }

    private function prepareData($data, $lineConfigSettings)
    {
        if (sizeof($data) > 0)
        {
            foreach (array_keys($data[0]) as $headerElement)
            {
                $this->_tableHeaderElements .= '<th>' . $headerElement . '</th>';
            }

            for ($i = 0; $i < $lineConfigSettings["numberOfLines"]; $i++)
            {
                $this->_tableRowElements .= '<tr>';
                foreach ($data[$i] as $value)
                {
                    $this->_tableRowElements .= '<td>' . $value . '</td>';
                }
                $this->_tableRowElements .= '</tr>';
            }
        }
    }
}