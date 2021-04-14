<?php

namespace App\Construct\Orm\Mysql;

use App\Construct\Model\keys;

class ConstructHasMany
{

    private array $hasMany = [];

    public function convert($value): void
    {
        $tableTakesReferences = keys::tableTakesReference($value['TABLE_NAME'], $value['COLUMN_NAME']);
        if (!is_null($tableTakesReferences)) {
            $tableTakesReference = $tableTakesReferences->toArray();
            array_push(
                $this->hasMany,
                [
                    'table'         =>  $tableTakesReference['REFERENCED_TABLE_NAME'],
                    'local_key'     =>  $tableTakesReference['REFERENCED_COLUMN_NAME'],
                    'foreign_key'   =>  $value['COLUMN_NAME']
                ]
            );
        }
    }

    public function get()
    {
        return $this->hasMany;
    }
}
