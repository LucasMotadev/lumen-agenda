<?php

namespace App;

use App\Model\BaseModel;
use App\Model\IModel;
use App\Validate\IValidate;
use App\Validate\UserValidate;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends BaseModel implements AuthenticatableContract, AuthorizableContract, JWTSubject, IValidate
{
    use Authorizable, Authenticatable , UserValidate;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'email', 'apelido', 'password'
    ];
    protected $hidden = [
        'password', 'token'
    ];

    public function setPasswordAttribute($password)
    {

        $this->attributes['password'] = Hash::make($password);
    }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
