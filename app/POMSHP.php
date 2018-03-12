<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class POMSHP extends Model
{
    protected $table='pomshp';

    protected $primaryKey = 'reqno';

    public $incrementing = false;


    public $timestamps = false;

    protected $fillable = [
        'recamt','shpdate','shipvia','fob','freight','takedays'
    ];

    public function poship(){
    	return $this->hasMany('App\POSHIP','reqno');
    }

    public function tempcontainer(){
    	
    	return $this->hasMany('App\Temp_Container','reqno');
    }

    
   
}
