<?php

namespace pdfgenerator\Util;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use pdfgenerator\Util\LayoutHandler;
use PhpParser\Node\Expr\AssignOp\Div;
use pdfgenerator\Util\Row;

class PDFGenerator
{
    private $_stylesheets = ["PDFStyles"];
    private $_layoutHandler = null;

    public function generatePDFFromJSONData($JSONdata, $fileNameExtension = "")
    {
        Log::info('*-------------------------------------------*');
        Log::info('|       Facade pdf generation started       |');
        $this->_layoutHandler = new LayoutHandler($this->_stylesheets);
        $snappy = App::make('snappy.pdf');
        $path = __DIR__ . '/../../temp/';
        $fileName = time() . $fileNameExtension . '.pdf';

        // Create new elements here
        $this->createPage($JSONdata, "firstpage");

        $snappy->generateFromHtml($this->_layoutHandler->getLayout(), $path . $fileName);
    }

    /**
     * TODO: Refactor this function
     */
    private function createPage($data, $page)
    {
        switch ($page) {
            case "firstpage":

                foreach ($data["layout"]["firstpage"] as $row)
                {
                    $rowInLayout = new Row();
                    foreach ($row as $col)
                    {
                        if ($col["element"]["type"] == "image") {
                            $element = new ImageElement($col["element"]["class"], $col["element"]["style"], $col["element"]["src"]);
                            $rowInLayout->addElementToRow($element);
                        }
                        else if ($col["element"]["type"] == "div") {
                            $element = new DivElement($col["element"]["class"], $col["element"]["style"], $col["element"]["content"]);
                            $rowInLayout->addElementToRow($element);
                        }
                        else if ($col["element"]["type"] == "lines") {
                            /*
                             * TODO: Extract only x number of lines from data variable
                             * TODO: Send config settings for LinesElement
                             */
                            $element = new LinesElement($col["element"]["class"], $col["element"]["style"], $data, "");
                            $rowInLayout->addElementToRow($element);
                        }
                    }
                    $this->_layoutHandler->addRow($rowInLayout);
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