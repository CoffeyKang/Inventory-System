<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FillUpSO extends Model
{
    protected $table = 'fillupso';

    public $timestamps = false;

    public function itemInfo(){
        
        return $this->belongsTo('App\Inventory','item');
    }

    public function custinfo(){
        return $this->belongsTo('App\Customer','custno');
    }
}
