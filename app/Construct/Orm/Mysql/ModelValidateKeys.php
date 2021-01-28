<?php

namespace App\Construct\Orm\Mysql;

use App\Construct\Model\keys;
use App\Construct\Orm\ImodelValidate;

class ModelValidateKeys implements ImodelValidate
{
    public function __construct(InitModelValidate $initModelValidate)
    {
        $this->initModelValidate = $initModelValidate;
    }
    public function get(): array
    {
        $tables = $this->initModelValidate->get();

        foreach ($tables as $table => $columns) {

            foreach ($columns['validate'] as $column => $validate) {

                #criar validate com base nas chaves
                $keys = keys::where('table_schema', env('DB_DATABASE_MYSQL'))
                    ->where('table_name', $table)
                    ->where('column_name', $column)
                    ->get()
                    ->toArray();

                foreach ($keys as  $value) {
                    #verifica de a cheve e primaria, se sim: adiciona validate 
                    if ($value['CONSTRAINT_NAME'] == 'PRIMARY') {
                        $tables[$table]['validate'][$column] .= "|unique:$table,$column|";
                    }

                    #verifica se a chave é unica, se sim adiciona validate
                    $fk = strpos($value['CONSTRAINT_NAME'], 'UNIQUE');
                    if ($fk !== false) {
                        $tables[$table]['validate'][$column] .= "|unique:$table,$column|";
                    }

                    #verifica se a cheve é extrangeira, se sim adiciona validate
                    $fk = strpos($value['CONSTRAINT_NAME'], 'fk');
                    if ($fk !== false) {

                        array_push(
                            $tables[$table]['hasMany'],
                            [
                                'table'         =>  $value['REFERENCED_TABLE_NAME'],
                                'local_key'     =>  $value['REFERENCED_COLUMN_NAME'],
                                'foreign_key'   =>  $column
                            ]
                        );
                        $tables[$table]['validate'][$column] .= "|exists:{$value['REFERENCED_TABLE_NAME']},{$value['REFERENCED_COLUMN_NAME']}|";
                    }

                    $tables[$table]['validate'][$column] =  preg_replace('/(^\|)|(\|$)/', '', $tables[$table]['validate'][$column]);
                    $tables[$table]['validate'][$column] =  preg_replace('/\|\|/', '|', $tables[$table]['validate'][$column]);
                }

                #verificar se o rercuso faz referecia para outro
                $keysSetFk = keys::where('table_schema', env('DB_DATABASE_MYSQL'))
                    ->where('referenced_table_name', $table)
                    ->where('referenced_column_name', $column)
                    ->get()
                    ->toArray();

                foreach ($keysSetFk as $key => $value) {
                    array_push(
                        $tables[$table]['belongsTo'],
                        [
                            'table' => $value['TABLE_NAME'],
                            'local_key' => $value['COLUMN_NAME'],
                            'foreign_key' => $column
                        ]
                    );
                }
            }
        }

        return $tables;
    }
}
