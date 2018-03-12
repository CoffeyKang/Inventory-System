<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustAddress extends Model
{
    //
    protected $table='aradrs';

    public $timestamps = false;

    /**
     * belongsTo customer
     */
    public function customer(){
    	return $this->belongsTo('App\Customer','custno');
    }
}
