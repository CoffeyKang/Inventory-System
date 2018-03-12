<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Armast extends Model
{
    //
    protected $table='armast';

    protected $primaryKey = 'invno';

    public $timestamps = false;

    protected $fillable = ['paidamt','balance','invdte','custno','dtepaid','shipping','tax','artype'];

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
        return $this->hasMany('App\TempInvoiceItem','invno');
    }
}
