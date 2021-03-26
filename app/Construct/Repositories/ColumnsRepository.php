<?php

namespace App\Construct\Repositories;

trait ColumnsRepository
{

    public static function featColumnsAndTypeTable(string $table)
    {
        return self::where(['table_name' => $table,  'table_schema' => env('DB_DATABASE_MYSQL')])
            ->orderBy('table_name')
            ->get()
            ->toArray();
    }
}
