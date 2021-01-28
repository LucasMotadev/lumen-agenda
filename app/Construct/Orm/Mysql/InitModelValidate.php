<?php

namespace App\Construct\Orm\Mysql;

use App\Construct\Model\Columns;

class InitModelValidate
{
    #class inicia a construção de um array para pasteriormente acrecentar mais infomações

    private $initModelValidate;
    private $columns;
  

    public function __construct($table = null)
    {
        $this->getColumns($table);
        $this->init();
    }
    public function getTableSelected():array
    {
        return $this->tableSelected;
    }

    public function get(){
        return $this->initModelValidate;
    }

    public function getColumns($table)
    {

        $model = Columns::where('table_schema', env('DB_DATABASE_MYSQL'));

        $tables = explode(',', $table);

        if ($table) {
            $model->whereIn('table_name', $tables);
        }

        $this->columns =  $model->orderBy('table_name')
            ->get()
            ->toArray();
    }

    public function init()
    {
        $table = [];

        foreach ($this->columns as $value) {


            $table[$value['TABLE_NAME']]['hasMany'] = [];
            $table[$value['TABLE_NAME']]['belongsTo'] = [];
            $table[$value['TABLE_NAME']]['validate'][$value['COLUMN_NAME']] = '';


            if (empty($table[$value['TABLE_NAME']]['fillable'])) {
                $table[$value['TABLE_NAME']]['fillable'] = [];
            }
            array_push($table[$value['TABLE_NAME']]['fillable'], $value['COLUMN_NAME']);


            if ($value['COLUMN_KEY'] == 'PRI') { #auto incremet é primaria, 
                $table[$value['TABLE_NAME']]['primaryKey'] = $value['COLUMN_NAME'];
                continue;
            }

            if (!isset($table[$value['TABLE_NAME']]['primaryKey'])) $table[$value['TABLE_NAME']]['primaryKey'] = '';


            $method = $value['DATA_TYPE'];
            $length = $value['CHARACTER_MAXIMUM_LENGTH'];
            $table[$value['TABLE_NAME']]['validate'][$value['COLUMN_NAME']] = $this->contextMethod($method, $length);

            if ($value['IS_NULLABLE'] == 'NO') {
                $table[$value['TABLE_NAME']]['validate'][$value['COLUMN_NAME']] .= "required|";
            }
        }

        $this->initModelValidate =  $table;
    }

    private function contextMethod($method, $value)
    {
        if (method_exists($this, $method)) {
            return $this->$method($value);
        }

        return '##########FORMATO NÃO DEFINIDO#########:' . $method;
    }

    public function int($length)
    {
        $max =  empty($length) ? 11 : $length;
        return "numeric|max:$max";
    }
    public function varchar($length)
    {
        return "string|max:$length";
    }

    public function datetime($length)
    {
        return "date_format:Y-m-d H:i:s";
    }

    public function date($length)
    {
        return "date_format:Y-m-d";
    }
}
