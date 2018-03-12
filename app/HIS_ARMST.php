<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HIS_ARMST extends Model
{
    protected $table='new_arymst';

    protected $primaryKey = 'invno';

    public $timestamps = false;

    /**
     * custinfo
     */
    public function custinfo(){
    	return $this->belongsTo('App\Customer','custno');
    }

    public function arcash(){
        return $this->hasMany('App\Arcash','invno');
    }
    /**
     * artran
     */
    public function artran(){
        return $this->hasMany('App\HIS_ARTRN','invno');
    }
}
