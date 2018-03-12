<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Araddr extends Model
{
    protected $table='araddr';

     protected $primaryKey = 'invno';
    
    public $incrementing = false;

    public $timestamps = false;
}
