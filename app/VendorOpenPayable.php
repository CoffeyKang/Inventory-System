<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorOpenPayable extends Model
{
    protected $table = 'vendoropenpayable';

    public $timestamps = false;

    protected $primaryKey = 'id';

    public function vendorInfo(){
    	return $this->belongsTo('App\Vendor','vendno');
    }
}
