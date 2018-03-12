<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorNotes extends Model
{
    protected $table='vendornotes';
    public $timestamps = false;

    /**
     * belongs to a vendor
     */
    public function vendor(){
    	return $this->belongsTo('App\Vendor','vendno');
    }

}
