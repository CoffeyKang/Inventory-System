<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Inventory;

class TempInvoiceItem extends Model
{
    protected $table = 'artran';

    protected $primaryKey = null;
    
    public $incrementing = false;

    public $timestamps = false;

    // public function itemInfo(){
    	
    // 	return $this->belongsTo('App\Inventory','item');
    // }

    public function somast(){
    	return $this->belongsTo('App\SalesOrder','sono');
    }

    public function itemInfo(){
        return $this->belongsTo('App\Inventory','item');
    }

    public function armast(){
        return $this->belongsTo('App\Armast','invno');
    }
}
