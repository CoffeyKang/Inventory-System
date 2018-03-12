<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class APCHCK extends Model
{
    protected $table = 'apchck';

    // protected $primaryKey = 'invno';

    // public $incrementing = false;

    protected $fillable = ['aprpay','ackacc','apstat'];


    public $timestamps = false;

    public function apdist(){
    	return $this->hasMany('App\APDIST','invno','invno');
    }
    
}
