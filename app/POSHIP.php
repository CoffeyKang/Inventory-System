<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class POSHIP extends Model
{
    protected $table='poship';


    public $timestamps = false;

    protected $fillable = [
        'qtyrec','extcost','takedays'
    ];

    public function toInventory(){

    	return $this->belongsTo('App\Inventory','item');
    }

    public function pomship(){
    	return $this->belongsTo('App\POMSHP','reqno');
    }

    public function duty(){
        return $this->belongsTo('App\CuptAndDuty','reqno');
    }
    
}
