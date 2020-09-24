<?php

namespace App\Model\Tables;

use Illuminate\Database\Eloquent\Model;

class NewView extends Model
{

    protected $table = "new_view";

    protected $fillabe = ["id", "descricao"];



    public function setPrimaryKey()
    {
        return $this->primaryKey;
    }
}
