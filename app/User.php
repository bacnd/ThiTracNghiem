<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany('App\Posts', 'user_id');
    }

    public function examresults() {
        return $this->hasMany('App\ExamResults', 'user_id');
    }

    public function role() {
        return $this->belongstoMany('App\Roles', 'users_roles', 'users_id', 'roles_id')->get()->first()->name;
    }
}
