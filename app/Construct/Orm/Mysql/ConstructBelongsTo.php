<?php

namespace App\Construct\Orm\Mysql;

use App\Construct\Model\keys;

class ConstructBelongsTo
{

    private array $belongsTo = [];

    public function convert($value): void
    {
        $tableReferenceds = keys::tableReferenced($value['TABLE_NAME'], $value['COLUMN_NAME']);

        foreach ($tableReferenceds as $key => $tableReferenced) {
            array_push(
                $this->belongsTo,
                [
                    'table' => $tableReferenced['TABLE_NAME'],
                    'local_key' => $tableReferenced['COLUMN_NAME'],
                    'foreign_key' => $value['COLUMN_NAME']
                ]
            );
        }
    }

    public function get()
    {
        return $this->belongsTo;
    }
}
