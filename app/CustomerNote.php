<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Customer;

class CustomerNote extends Model
{
    protected $table ='customernotes';

    public $timestamps = false;

    public function customer(){

    	return $this->belongsTo('App\Customer','custno');
    	
    }
}
