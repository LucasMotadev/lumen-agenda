<?php

namespace App\Construct\Orm\Mysql;


class ConstructPrimaryKey
{

    private string $primaryKey =  '';

    public function convert($value): void
    {
        if ($value['COLUMN_KEY'] == 'PRI') {
            $this->primaryKey = $value['COLUMN_NAME'];
        }
    }

    public function get()
    {
        return $this->primaryKey;
    }
}
