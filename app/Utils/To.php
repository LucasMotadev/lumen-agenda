<?php

namespace App\Utils;

class To
{

    public static function snackCaseToCamelCase(string $text)
    {
        $arr = explode('-', $text);
        $newText = '';
        foreach ($arr as $value) {
            $newText .= ucfirst($value);
        }
        return lcfirst($newText);
    }
}
