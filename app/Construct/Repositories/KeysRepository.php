<?php

namespace App\Construct\Repositories;

trait KeysRepository
{
    public static function featKeyColumnTable($table, $column)
    {
        return self::where('table_schema', env('DB_DATABASE_MYSQL'))
            ->where('table_name', $table)
            ->where('column_name', $column)
            ->first();
    }

    public static function tableReferenced($table, $column)
    {
        return   self::where('table_schema', env('DB_DATABASE_MYSQL'))
            ->where('referenced_table_name', $table)
            ->where('referenced_column_name', $column)
            ->get()
            ->toArray();
    }

    public static function tableTakesReference($table, $column){
        return self::where('table_schema', env('DB_DATABASE_MYSQL'))
        ->where('table_name', $table)
        ->where('column_name', $column)
        ->where('CONSTRAINT_NAME', 'like', '%fk%')
        ->first();
       
    }

}
