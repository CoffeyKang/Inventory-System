<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\SalesOrder;

class TempSOItem extends Model
{
    //store item when a sales order is created
    protected $table ='sotran';

    //protected $primaryKey = false;



    public $timestamps = false;

    public function somast(){
    	return $this->belongsTo('App\SalesOrder','sono');
    }

    //inventory info
    public function iteminfo(){
    	return $this->belongsTo('App\Inventory','item');
    }
    //custno
    public function custinfo(){
    	return $this->belongsTo('App\Customer','custno');
    }
}
