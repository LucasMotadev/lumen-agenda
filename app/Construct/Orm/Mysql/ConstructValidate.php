<?php

namespace App\Construct\Orm\Mysql;

use App\Construct\Model\keys;

class ConstructValidate
{

    private array $validate = [];

    public function convert($value)
    {
        $this->validateByType($value);
        $this->validateByRestriction($value['TABLE_NAME'], $value['COLUMN_NAME']);
    }

    private function validateByType($value)
    {
        $this->validate[$value['COLUMN_NAME']] = '';
        $method = $value['DATA_TYPE'];
        $length = $value['CHARACTER_MAXIMUM_LENGTH'];
        $this->validate[$value['COLUMN_NAME']] .= (new DataTypeColumnToValidate($method, $length))->get();

        if ($value['IS_NULLABLE'] == 'NO') {
            $this->validate[$value['COLUMN_NAME']] .= "|required|";
        }
    }

    private function validateByRestriction(string $table, string $column)
    {
        $keys = keys::featKeyColumnTable($table, $column);
        if (is_null($keys)) return;

        $keys = $keys->toArray();

        $this->unique($keys, $column, $table);
        $this->foreign($keys, $column);
        $this->format($column);
    }

    private function foreign($keys, $column)
    {
        #verifica se a cheve é extrangeira
        $fk = strpos($keys['CONSTRAINT_NAME'], 'fk');
        if ($fk !== false) {
            $this->validate[$column] .= "|exists:{$keys['REFERENCED_TABLE_NAME']},{$keys['REFERENCED_COLUMN_NAME']}|";
        }
    }

    private function unique($keys, $column, $table)
    {
        #verifica de a cheve e primaria
        if ($keys['CONSTRAINT_NAME'] == 'PRIMARY') {
            $this->validate[$column] .= "|unique:$table,$column|";
        }

        #verifica se a chave é unica
        $fk = strpos($keys['CONSTRAINT_NAME'], 'UNIQUE');
        if ($fk !== false) {
            $this->validate[$column] .= "|unique:$table,$column|";
        }
    }

    private function format($column)
    {
        $this->validate[$column] =  preg_replace('/(^\|)|(\|$)/', '', $this->validate[$column]);
        $this->validate[$column] =  preg_replace('/\|\|/', '|', $this->validate[$column]);
    }

    public function get()
    {
        return $this->validate;
    }
}
