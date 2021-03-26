<?php

namespace App\Construct\Orm\Mysql;

class DataTypeColumnToValidate
{
    private $validate;

    public function __construct($method, $value)
    {
        $this->validate = $this->contextMethod($method, $value);
    }

    private function contextMethod($method, $value)
    {
        if (method_exists($this, $method)) {
            return $this->$method($value);
        }

        return '##########FORMATO NÃO DEFINIDO#########:' . $method;
    }

    private function int($length)
    {
        $max =  empty($length) ? 11 : $length;
        return "numeric|max:$max|";
    }
    private function varchar($length)
    {
        return "string|max:$length|";
    }

    private function datetime($length)
    {
        return "date_format:Y-m-d H:i:s";
    }

    private function date($length)
    {
        return "date_format:Y-m-d";
    }

    public function get()
    {
        return $this->validate;
    }
}
