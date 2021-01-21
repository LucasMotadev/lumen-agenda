<?php

namespace App\Construct\Controller;

use App\Construct\Model\Columns;
use App\Construct\Model\keys;
use App\Construct\Files\Model;
use App\Construct\Files\Router;
use Exception;

class CreateModels  extends BaseCreate
{
    private $Model;
    private $Router;
    public function __construct()
    {
        $this->Model = new Model();
        $this->Router = new Router();
    }
    public function create()
    {

        $model = Columns::where('table_schema', env('DB_DATABASE_MYSQL'))
            ->orderBy('table_name')
            ->get()
            ->toArray();

        $tables = $this->groupColumn($model);
        
        dd($this->getStringClass($tables));
    }

    private function getStringClass($arr = [])
    {
        $arrModels = [];
        $arrRouters = [];
        $filePath = "app/Model/Tables/"; // filename save file
        $nameSpaceModel = ucfirst(str_replace('/','\\',substr( $filePath, 0 , -1)));
    
        foreach ($arr as $table => $columns) {
            $nomeRouter = $this->Router->classToCamelcase($table);
            $this->Router->setRouterGroup(
                $nomeRouter   
            );

            $router = $this->createFile(
                base_path('routes/api/'. lcfirst($nomeRouter) .'.php'),
                $this->Router->getRouterGroup()
            );

            array_push($arrRouters, $router);

            $this->Model->setTable($table);
            $this->Model->setFunctionPk();
            $this->Model->setFillable($columns);

            foreach ($columns as  $column) {

                $modelPrimaryKey = keys::where('table_schema', env('DB_DATABASE_MYSQL'))
                    ->where('table_name', $table)
                    ->where('column_name', $column)
                    ->get()
                    ->toArray();

                foreach ($modelPrimaryKey as  $value) {

                    if ($value['CONSTRAINT_NAME'] == 'PRIMARY') $this->Model->setPrimaryKey($value['COLUMN_NAME']);

                    $fk = strpos($value['CONSTRAINT_NAME'], 'fk');
                    if ($fk !== false) {

                        $this->Model->setBelongsTo(
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
                    $this->Model->setHasMany(
                        $value['TABLE_NAME'],
                        "App\Models\Tables",
                        $value['COLUMN_NAME'],
                        $value['REFERENCED_COLUMN_NAME']
                    );
                }
            }
           
            
            $response = $this->createFile(
                base_path($filePath) . $this->Model->classToCamelcase($table).".php", // filename
                $this->Model->getClass($nameSpaceModel, $table)        // namespace
            );

            array_push($arrModels, $response);

            $this->Model->destroy();
        }

        return [$arrModels, $arrRouters];
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



}
