<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    //
    protected $table = 'somast';

    protected $primaryKey = 'sono';

    public $timestamps = false;

    protected $fillable=['lastmodified'];

    public function details(){
    	return $this->hasMany('App\TempSOItem','sono');
    }

    public function soship(){
    	return $this->hasMany('App\Shipment','sono');
    }
    public function customer(){
        return $this->belongsTo('App\Customer','custno');
    }
}
