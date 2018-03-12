<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GLA_Address extends Model
{
	protected $table = 'gla_address';
	
	public $timestamps = false;

	public function poShipTo(){
		return $this->hasMany('App\POShipTo','addressType','id');
	}


}
