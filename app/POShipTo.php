<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class POShipTo extends Model
{
    protected $table ='poshipto';
    public $timestamps = false;

    public function addressType(){
    	return $this->belongsTo('App\GLA_Address','addressType');
    }
}
