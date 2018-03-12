<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Inventory;

class itemNotes extends Model
{
    protected $table = 'itemnotes';

    public $timestamps = false;

    public function item(){
    	
    	return $this->belongsTo('App\Inventory','item');
    }
}
