<?php

namespace App\Construct\Created;

use App\Construct\Files\ControllerFile;
use App\Construct\Model\Columns;
use App\Construct\Model\keys;

use App\Construct\Files\ModelFile;

use App\Construct\Files\RouterFile;
use Illuminate\Http\Request;


class CreateModels  extends BaseCreate
{
    public function getModelValidate($table)
    {
        $model = Columns::where('table_schema', env('DB_DATABASE_MYSQL'));

        if ($table) {
            $model->where('table_name', $table);
        }

        $tables =  $model->orderBy('table_name')
            ->get()
            ->toArray();

        $tablesInitValidate = $this->groupColumnValidate($tables);
        $validateAll = $this->setValidateKeys($tablesInitValidate);
        return $validateAll;
    }

    public function createdModelValidate(Request $request)
    {

        $model = Columns::where('table_schema', env('DB_DATABASE_MYSQL'));

        if ($request->table) {
            $model->where('table_name', $request->table);
        }

        $tables =  $model->orderBy('table_name')
            ->get()
            ->toArray();

        $tablesInitValidate = $this->groupColumnValidate($tables);
        $validateAll = $this->setValidateKeys($tablesInitValidate);

        $modelFile = new ModelFile();
        $modelFile->createClass($validateAll, $request->pathModel);

        $controllerFile = new ControllerFile();
        $controllerFile->createClass($validateAll, $request->pathController, $request->pathModel, $request->pathValidate);

        return $validateAll;
    }


    private function setValidateKeys(array $tables)
    {

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
                        $tables[$table]['validate'][$column] .= "unique:$table,$column|";
                    }

                    #verifica se a chave é unica, se sim adiciona validate
                    $fk = strpos($value['CONSTRAINT_NAME'], 'UNIQUE');
                    if ($fk !== false) {
                        $tables[$table]['validate'][$column] .= "unique:$table,$column|";
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
                        $tables[$table]['validate'][$column] .= "exists:{$value['REFERENCED_TABLE_NAME']},{$value['REFERENCED_COLUMN_NAME']}|";
                    }

                    $tables[$table]['validate'][$column] = substr($tables[$table]['validate'][$column], 0, -1);
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


    private function groupColumnValidate($arr = [])
    {

        $table = [];


        foreach ($arr as $value) {

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

        return $table;
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
