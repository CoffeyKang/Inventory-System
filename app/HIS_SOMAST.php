<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HIS_SOMAST extends Model
{	
	protected $table = 'soymst';

    public $timestamps =false;

    protected $primaryKey = 'sono';

    public function details(){
    	return $this->hasMany('App\HIS_SOYTRN','sono');
    }

    public function soship(){
    	return $this->hasMany('App\HIS_SOYSHP','sono');
    }
}
