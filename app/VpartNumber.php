<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VpartNumber extends Model
{
    protected $table='arisup01';

    /**
     * relationship to vendor
     */
    public function vendor(){
    	return $this->belongsTo('App\Vendor','vendno');
    }
}
