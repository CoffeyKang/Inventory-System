<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Inventory;

class AdjustInventory extends Model
{
    protected $table='adjustinventory';

    protected $primaryKey = 'number';

    public $timestamps = false;

    public function inventory(){

    	return $this->belongsTo('App\Inventory','item');
    }
}
