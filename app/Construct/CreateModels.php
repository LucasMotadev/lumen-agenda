<?php

namespace App\Construct;

use Exception;

class CreateModels extends Model
{
    public function models()
    {

        $model = Columns::where('table_schema', env('DB_DATABASE_MYSQL'))
            ->orderBy('table_name')
            ->get()
            ->toArray();

        $tables = $this->groupColumn($model);

        return response()->json($this->getStringClass($tables), 200);
    }



    private function getStringClass($arr = [])
    {
        $arrModels = [];

        foreach ($arr as $table => $columns) {

            $this->setTable($table);
            $this->setFunctionPk();
            $this->setFillable($columns);

            foreach ($columns as  $column) {

                $modelPrimaryKey = keys::where('table_schema', env('DB_DATABASE_MYSQL'))
                    ->where('table_name', $table)
                    ->where('column_name', $column)
                    ->get()
                    ->toArray();

                foreach ($modelPrimaryKey as  $value) {

                    if ($value['CONSTRAINT_NAME'] == 'PRIMARY') $this->setPrimaryKey($value['CONSTRAINT_NAME']);

                    $fk = strpos($value['CONSTRAINT_NAME'], 'fk');
                    if ($fk !== false) {

                        $this->setBelongsTo(
                            $value['REFERENCED_TABLE_NAME'],
                            'App\Model\Tabels',
                            $value['COLUMN_NAME'],
                            $value['REFERENCED_COLUMN_NAME']
                        );
                    }
                }

                $modelForenKey = keys::where('table_schema', env('DB_DATABASE_MYSQL'))
                    ->where('referenced_table_name', $table)
                    ->where('referenced_column_name', $column)
                    ->get()
                    ->toArray();

                foreach ($modelForenKey as  $value) {
                    $this->setHasMany(
                        $value['TABLE_NAME'],
                        "App\Models\Tables",
                        $value['COLUMN_NAME'],
                        $value['REFERENCED_COLUMN_NAME']
                    );
                }
            }
            // dd($this->getClass('App/Model/Tables/', $table));
            $response = $this->createFileModel(
                base_path("app/Model/Tables/{$this->classToCamelcase($table)}.php"),
                $this->getClass('App\Model\Tables', $table)
            );

            array_push($arrModels, $response);

            $this->destroy();
        }

        return $arrModels;
    }

    private function groupColumn($arr = [])
    {

        $table = [];
        foreach ($arr as $value) {
            if (empty($table[$value['TABLE_NAME']])) $table[$value['TABLE_NAME']] = [];
            array_push($table[$value['TABLE_NAME']], $value['COLUMN_NAME']);
        }

        return $table;
    }


    private function createFileModel($filename, $data)
    {
        if (file_exists($filename)) throw new Exception("Erro ao criar Class  {$this->classToCamelcase($filename)}, o arquivo já existe");
        $arquivo = fopen($filename, 'w');
        if (!$arquivo) throw new Exception("Erro ao criar Class  {$this->classToCamelcase($filename)}");
        fwrite($arquivo, $data);
        //Fechamos o arquivo após escrever nele
        fclose($arquivo);

        return $filename;
    }
}
