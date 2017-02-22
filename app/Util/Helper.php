<?php

namespace pdfgenerator\Util;


class Helper
{
    public function unwrapArray($array)
    {
        $unwrappedArray = array_pop($array);

        foreach ($array as $item)
        {
            $unwrappedArray .= " " . $item;
        }

        return $unwrappedArray;
    }
}