<?php

namespace App\Construct;

use Exception;

class CreateModels
{
  public function models()
  {

    $model = Columns::where('table_schema', env('DB_DATABASE_MYSQL'))
      ->orderBy('table_name')
      ->get()
      ->toArray();

    $tables = $this->groupColumn($model);

    $this->getStringClass($tables);
  }




  private function getStringClass($arr = [])
  {
    $arrModels = [];

    $lineTable = '';
    $lineColumn =  '';
    $linePrimaryKey = '';
    $fkonToAll = '';
    $fkoneToOne = '';
    $lineGurad = '';
    $functionGetPrimariky = '';

    foreach ($arr as $table => $columns) {
      $lineTable =  '     protected $table = "' .  strtolower($table) . '";';

      $functionGetPrimariky = '     public function getPrimaryKey(){
                return $this->primaryKey;
            }';
      foreach ($columns as  $column) {

        $lineColumn .=  "'" . strtolower($column) . "',";

        $modelPrimaryKey = keys::where('table_schema', env('DB_DATABASE_MYSQL'))
          ->where('table_name', $table)
          ->where('column_name', $column)
          ->get()
          ->toArray();

        foreach ($modelPrimaryKey as  $value) {

          if ($value['CONSTRAINT_NAME'] == 'PRIMARY') $linePrimaryKey =  '     protected $primaryKey = "' . strtolower($column) . '";';

          $fk = strpos($value['CONSTRAINT_NAME'], 'fk');
          if ($fk !== false) {

            $fkoneToOne .= '     public function ' . $this->methodToCamelcase($value['REFERENCED_TABLE_NAME']) . '()
                        {
                            return $this->belongsTo("App\Models\Tables", "' . strtolower($value['COLUMN_NAME']) . '","' . strtolower($value['REFERENCED_COLUMN_NAME']) . '");
                        }
                          
                        ';
          }
        }

        $modelForenKey = keys::where('table_schema', env('DB_DATABASE_MYSQL'))
          ->where('referenced_table_name', $table)
          ->where('referenced_column_name', $column)
          ->get()
          ->toArray();

        foreach ($modelForenKey as  $value) {

          $fkonToAll .= '     public function ' . $this->methodToCamelcase($value['TABLE_NAME']) . '()
                    {
                        return $this->hasMany("App\Models\Tables", "' . strtolower($value['COLUMN_NAME']) . '","' . strtolower($value['REFERENCED_COLUMN_NAME']) . '");
                    }';
        }
      }


      $lineColumn = substr($lineColumn, 0, -1);;
      $lineFillable = '     protected $fillable = [' . $lineColumn . '];';

      $stryngClass = "<?php

    namespace App\Model\Tables;

    use Illuminate\Database\Eloquent\Model;
    

    class {$this->classToCamelcase($table)} extends Model {

        $lineTable

        $lineFillable

        $linePrimaryKey

        $functionGetPrimariky


        $fkonToAll
            
        $fkoneToOne

    }";
      $this->createFileModel(base_path("app/Model/Tables/{$this->classToCamelcase($table)}.php"), $stryngClass);

      $lineColumn = '';
      $fkonToAll = '';
      $fkoneToOne = '';
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

  private function classToCamelcase($name)
  {

    $arrName = explode('_', strtolower($name));
    $newName = '';

    foreach ($arrName as  $value) {
      $newName .= ucfirst($value);
    }

    return $newName;
  }

  private function methodToCamelcase($name)
  {

    $arrName = explode('_', strtolower($name));
    $newName = '';
    foreach ($arrName as $key => $value) {

      if ($key === 0) {
        $newName = $value;
      } else {

        $newName .= ucfirst($value);
      }
    }

    return $newName;
  }


  private function createFileModel($filename, $data)
  {

    if (file_exists($filename)) throw new Exception("Erro ao criar Class  {$this->classToCamelcase($filename)}, o arquivo já existe");
    $arquivo = fopen($filename, 'w');
    if (!$arquivo) throw new Exception("Erro ao criar Class  {$this->classToCamelcase($filename)}");
    fwrite($arquivo, $data);
    //Fechamos o arquivo após escrever nele
    fclose($arquivo);
  }
}
