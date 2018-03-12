<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apmast extends Model
{
    protected $table='apmast';

    protected $primaryKey = 'invno';

   	public $incrementing = false; 

    public $timestamps = false;

    protected $fillable = ['puramt', 'paidamt', 'duedate','checkdate','apacc','checkno'];

    /**
     * ralationship to apdist
     */
    public function apdist(){
    	return $this->hasMany('App\APDIST','invno');
    }
    /**
     * ralationship to vendor info
     */
    public function vendor(){
        return $this->belongsTo('App\Vendor','vendno');
    }
}
