<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{

    public function getPrimaryKey(){
        return $this->primaryKey;
    }

    public function getFillable()
    {
        return $this->fillable;
    }

}
