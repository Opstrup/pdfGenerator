<?php
/**
 * Created by PhpStorm.
 * User: IT Minds
 * Date: 13-02-2017
 * Time: 13:13
 */

namespace pdfgenerator\Util;


class LayoutHandler
{
    private $_layoutStyle;
    private $_openingContainer = '<div class="container">';
    private $_closingContainer = '</div>';

    function __construct() {
        $this->_layoutStyle = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
    }

    public function getLayout()
    {
        return $this->_layoutStyle . $this->_openingContainer . $this->_closingContainer;
    }

}