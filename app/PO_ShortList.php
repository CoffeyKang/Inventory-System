<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PO_ShortList extends Model
{
    protected $table='poshortlists';
    
    public $timestamps = false;

    public function iteminfo(){
    	return $this->belongsTo('App\Inventory','item');
    }
}
