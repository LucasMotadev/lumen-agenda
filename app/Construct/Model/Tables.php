<?php

namespace App\Construct\Model;

use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    protected $table = 'information_schema.tables';
    protected $primaryKey = 'table_name';

    protected $fillables = [
        'table_name'
    ];

}
