<?php

namespace pdfgenerator\Util;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use pdfgenerator\Util\LayoutHandler;
use PhpParser\Node\Expr\AssignOp\Div;

class PDFGenerator
{
    private $_stylesheets = ["PDFStyles"];
    private $_layoutHandler = null;

    public function generatePDFFromJSONData($JSONdata)
    {
        Log::info('*-------------------------------------------*');
        Log::info('|       Facade pdf generation started       |');
        $this->_layoutHandler = new LayoutHandler($this->_stylesheets);
        $snappy = App::make('snappy.pdf');
        $path = __DIR__ . '/../../temp/';
        $fileName = time() . '.pdf';

        // Create new elements here
        $this->createPage($JSONdata, "firstpage");

        $snappy->generateFromHtml($this->_layoutHandler->getLayout(), $path . $fileName);
    }

    private function createPage($data, $page)
    {
        switch ($page) {
            case "firstpage":

                foreach ($data["layout"]["firstpage"] as $row)
                {
                    foreach ($row as $col)
                    {
                        if ($col["element"]["type"] == "image") {
                            $element = new ImageElement([], [], $col["element"]["src"]);
                            $this->_layoutHandler->addElement($element);
                        }
                        else if ($col["element"]["type"] == "div") {
                            $element = new DivElement(["col-md-12"], []);
                            $this->_layoutHandler->addElement($element);
                        }
                    }
                }

                break;
            case "secondpage":

                break;
            case "lastpage":

                break;
            default:
                return true;
        }
    }
}