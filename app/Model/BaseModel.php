<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function getPrimaryKey(){
        return $this->primaryKey;
    }

}
