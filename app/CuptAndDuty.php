<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuptAndDuty extends Model
{
    protected $table='cuptandduty';

    public $timestamps = false;

    

    protected $fillable = ['cupt', 'duty'];

    public function poship(){
    	return $this->hasMany('App\POSHIP','reqno');
    }
}
