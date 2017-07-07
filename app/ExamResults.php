<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamResults extends Model
{
	protected $table = 'examresults';

	protected $fillable = [ 'point', 'time', 'user_id', 'post_id' ];

    public function users()
    {
    	return $this->belongsto('App\User', 'user_id');
    }

}
