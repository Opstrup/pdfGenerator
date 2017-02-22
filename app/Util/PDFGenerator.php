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
    private $_scripts = ["PDFStyleHelper"];
    private $_layoutHandler = null;

    public function generatePDFFromJSONData($JSONdata, $fileNameExtension = "")
    {
        Log::info('*-------------------------------------------*');
        Log::info('|       Facade pdf generation started       |');
        $this->_layoutHandler = new LayoutHandler($this->_stylesheets, $this->_scripts);
        $snappy = App::make('snappy.pdf');
        $path = __DIR__ . '/../../temp/';
        $fileName = time() . $fileNameExtension . '.pdf';

        $this->createPage($JSONdata, "firstpage");

        $snappy->generateFromHtml($this->_layoutHandler->getLayout(), $path . $fileName,
            array('lowquality' => false,
            'encoding' => 'utf-8',
            'images' => true,
            'enable-javascript' => true));
    }

    private function createPage($data, $page)
    {
        switch ($page) {
            case "firstpage":

                foreach ($data["layout"][$page] as $row)
                {
                    $rowInLayout = new Row();
                    foreach ($row as $col)
                    {
                        $rowInLayout->addElementToRow($this->createContentForRow($col, $data));
                    }
                    $this->_layoutHandler->addRow($rowInLayout);
                }
                break;
            case "lastpage":
                foreach ($data["layout"][$page] as $row)
                {
                    $rowInLayout = new Row();
                    foreach ($row as $col)
                    {
                        $rowInLayout->addElementToRow($this->createContentForRow($col, $data));
                    }
                    $this->_layoutHandler->addRow($rowInLayout);
                }
                break;
            default:
                return true;
        }
    }

    /**
     * TODO: Refactor the constructors for the elements, abstract factory pattern
     */
    private function createContentForRow($col, $linesData)
    {
        if ($col["element"]["type"] == "image") {
            return new ImageElement($col["element"]["class"], $col["element"]["style"], $col["element"]["src"]);
        }
        else if ($col["element"]["type"] == "div") {
            return new DivElement($col["element"]["class"], $col["element"]["style"], $col["element"]["content"]);
        }
        else if ($col["element"]["type"] == "lines") {
            /*
             * TODO: Extract only x number of lines from data variable
             * TODO: Send config settings for LinesElement
             */
            return new LinesElement($col["element"]["table-class"], $col["element"]["class"], $col["element"]["style"], $linesData["data"]["lines"], "");
        }
        else if ($col["element"]["type"] == "footer") {
            return new FooterElement($col["element"]["class"], $col["element"]["style"], $col["element"]["content"]);
        }
    }
}