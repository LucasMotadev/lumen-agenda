<?php

namespace App\Model\Tables;

use Illuminate\Database\Eloquent\Model;

class GrupoPermissions extends Model
{

    protected $table = "grupo_permissions";

    protected $fillabe = ["permission_id", "grupo_user_id"];

    protected $primaryKey = "";



    public function permissions()
    {
        return $this->hasMany("permissions::class", "id", "permission_id");
    }

    public function gruposUsers()
    {
        return $this->hasMany("gruposUsers::class", "id", "grupo_user_id");
    }
}
