<?php

namespace App\Construct\Model;

use App\Construct\Repositories\ColumnsRepository;

class Columns extends BaseModel
{
    use ColumnsRepository;
    protected $table = 'information_schema.columns';
    
}
