<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntireSOShortlist extends Model
{
    protected $table ='entiresoshortlists';

    public $timestamps = false;

    public function iteminfo(){
    	return $this->belongsTo('App\Inventory','item');
    }
}
