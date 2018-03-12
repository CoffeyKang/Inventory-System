<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Glacnt extends Model
{
    protected $table = 'glacnt';


    public $timestamps =false;
    
    public function apdist(){
    	return $this->hasOne('App\APDIST','account','glacnt');
    }

    public function total(){
    	return $this->hasMany('App\APDIST','account','glacnt');
    }

    public function cal_total($from,$end,$acc){
    	
    	$apdist_amount = APDIST::whereBetween('pstdate',[$from,$end])->where('account',$acc)->get()->sum('amount');

    	return $apdist_amount;



    }
}
