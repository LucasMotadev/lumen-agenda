<?php

namespace App\Construct\Model;

class Tables extends BaseModel
{
    protected $table = 'information_schema.tables';
    protected $primaryKey = 'table_name';

    protected $fillables = [
        'table_name'
    ];

}
