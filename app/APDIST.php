<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class APDIST extends Model
{
    protected $table = 'apdist';


    public $timestamps = false;

    public function apmast(){
    	return $this->belongsTo('App\Apmast','invno');
    }

    public function glacnt(){
    	return $this->hasOne('App\Glacnt','glacnt','account');
    }

    public function inTotal(){
    	return $this->belongsTo('App\Glacnt','glacnt','account');
    }

    public function apcheck(){
        return $this->belongsTo('App\APCHCK','invno','invno');
    }
}
