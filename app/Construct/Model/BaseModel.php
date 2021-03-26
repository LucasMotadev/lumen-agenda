<?php

namespace App\Construct\Model;

use App\Utils\Regex;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class BaseModel extends Model
{

    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }
    public function getFillable(): array
    {
        return $this->fillable;
    }

    public function getIntersectGroupBy(string $column)
    {

        $clearSpace = explode(',', preg_replace('/\s+/', '', $column));
        return array_intersect($clearSpace, $this->getFillable());
    }

    public function getKeyIntersectRequestFillableModel(Request $request): array
    {
        $valuesInKeys = array_fill_keys($this->getFillable(), '1');
        return array_intersect_key($request->all(), $valuesInKeys);
    }

    protected function convertStringToArray($arrayString)
    {
        if (is_array($arrayString)) return $arrayString;
        if (preg_match('/\w+,\w+/', $arrayString, $matches)) return explode(',', $arrayString);
        return $arrayString;
    }

    public  function queryStringToElequente(Request $request)
    {
        $this->model = self::select();
        $arr = $this->getKeyIntersectRequestFillableModel($request);

        foreach ($arr as $key => $value) {
            $value = $this->convertStringToArray($value);
            $this->whereInOrWhere($key, $value);
        }
        return $this->model;
    }

    private  function whereInOrWhere($key, $value)
    {
        if (is_array($value)) {
            return $this->whereInOrWhreBetWeen($key, $value);
        }
        return   $this->model->where($key, $value);
    }

    private function whereInOrWhreBetWeen($key, $value)
    {
        if (count($value) != 2) return $this->model->whereIn($key, $value);
        
        if ($this->twoPositionIsDate($value[0], $value[1])) { // as posição são datas
             
            return $this->model->whereBetWeen($key, self::invetDateIfFirstLargerLast($value[0], $value[1]));
        }

        return  $this->model->whereIn($key, $value);
    }

    private function twoPositionIsDate($firstDate, $lastDate){
        $regex =  new Regex();
        $regexDate = $regex->date()->get('i');
        return preg_match($regexDate, $firstDate) && preg_match($regexDate, $lastDate);
    }

    private static function invetDateIfFirstLargerLast($firstDate, $lastDate)
    {
        if (strtotime($firstDate) > strtotime($lastDate)) { // a data menor primeiro
            $aux = $lastDate;
            $lastDate = $firstDate;
            $firstDate = $aux;
        }

        return [$firstDate, $lastDate];
    }
}
