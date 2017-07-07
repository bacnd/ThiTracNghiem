<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersRoles extends Model
{
	protected $table = 'users_roles';

    protected $fillable = [
        'users_id', 'roles_id'
    ];

    public $timestamps = false;
}
