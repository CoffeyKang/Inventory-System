<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp_Container extends Model
{
   	protected $table='temp_container';

   	public $timestamps = false;

   	public function itemInfo(){
   		return $this->belongsTo('App\Inventory','item');
   	}

   	public function pomshp(){
   		return $this->belongsTo('App\POMSHP','reqno');
   	}
}
