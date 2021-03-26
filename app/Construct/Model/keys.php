<?php

namespace App\Construct\Model;

use App\Construct\Repositories\KeysRepository;

class keys extends BaseModel
{
    use KeysRepository;
    protected $table = 'information_schema.KEY_COLUMN_USAGE';

}
