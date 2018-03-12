<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HIS_ARTRN extends Model
{
    protected $table = 'new_arytrn';

    protected $primaryKey = null;
    
    public $incrementing = false;

    public $timestamps = false;

    public function somast(){
    	return $this->belongsTo('App\SalesOrder','sono');
    }

    public function itemInfo(){
        return $this->belongsTo('App\Inventory','item');
    }

    public function armast(){
        return $this->belongsTo('App\HIS_ARTRN','invno');
    }
}
