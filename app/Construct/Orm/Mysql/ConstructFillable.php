<?php

namespace App\Construct\Orm\Mysql;

use App\Construct\Model\Columns;

class ConstructFillable {

    private array $fillable = [];

    public function convert($value):void
    {
        array_push($this->fillable, $value['COLUMN_NAME']);
    }

    public function get()
    {
        return $this->fillable;
    }
}   