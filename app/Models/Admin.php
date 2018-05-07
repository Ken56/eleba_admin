<?php

namespace App\Models;
//Authenticatable
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustTeamTrait;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use LaratrustUserTrait;//rbac插件
    protected $table='admins';
    protected $fillable = [
        'name', 'email',
    ];
    protected $hidden = [
         'password','remember_token',
    ];
}
