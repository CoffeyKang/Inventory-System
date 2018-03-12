<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    
    protected $table = 'soship';

    protected $primaryKey = false;
    
    public $incrementing = false;

    public $timestamps = false;


}
