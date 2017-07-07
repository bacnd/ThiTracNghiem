<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
	protected $table = 'posts';

    protected $fillable = [
        'title', 'path_file', 'result', 'time', 'cat_id', 'user_id'
    ];

    public function categories()
    {
    	return $this->belongsto('App\Categories', 'cat_id');
    }

    public function users()
    {
    	return $this->belongsto('App\User', 'user_id');
    }
}
