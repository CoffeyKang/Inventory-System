<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TEMP_PO extends Model
{
    protected $table ='potran';

    



    public $timestamps = false;

    protected $fillable = ['qtyord','taxrate','extcost'];

    public function toInventory(){

    	return $this->belongsTo('App\Inventory','item');
    }

    public function pomast(){
    	
    	return $this->belongsTo('App\PO','purno');
    }
}
