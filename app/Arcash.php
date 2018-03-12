<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arcash extends Model
{
    protected $table='arcash';

    protected $primaryKey =false;

    public $incrementing = false;

    public $timestamps = false;

    public function custinfo(){
    	return $this->belongsTo('App\Customer','custno');
    }

    public function armast(){
    	return $this->belongsTo('App\Armast','invno');
    }
}
