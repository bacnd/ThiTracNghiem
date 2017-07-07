<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
	protected $table = 'roles';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function users()
    {
    	return $this->belongstoMany('App\User');
    }
}
