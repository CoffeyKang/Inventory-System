<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customerOpenReceivable extends Model
{
    protected $table='customeropenreceivable';

    public $fillable = ['custno','day30','current','day60','day90','day120'];

    public $timestamps = false;

    public function custinfo(){
    	return $this->belongsTo('App\Customer','custno');
    }

}
