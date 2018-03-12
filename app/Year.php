<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $table = 'arimak01';

    protected $primaryKey = 'row_id';

    public $timestamps = false;

   	/**
   	 * relationship to inventory item
   	 */
   	public function inventory(){
   		return $this->hasMany('App\inventory','item','item');
   	}

}
