<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Customer;

class CustomerEmail extends Model
{
    protected $table='armail';

    public $timestamps = false;

    protected $fillable = ['email','contact'];

    public function customer(){

    	return $this->belongsTo('APP/customer','custno');
    }
}
