<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    //
    protected $table='pomast';

    protected $primaryKey = 'purno';

    public $timestamps = false;

    public $incrementing = false;

    public function potran(){
    	return $this->hasMany('App\TEMP_PO','purno');
    }

    public function poship(){
    	return $this->hasMany('App\POSHIP','purno');
    }
}
