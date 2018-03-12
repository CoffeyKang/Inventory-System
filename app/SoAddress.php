<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoAddress extends Model
{
    //
    protected $table ='soaddr';

    protected $primaryKey = 'sono';
    
    public $incrementing = false;

    public $timestamps = false;
}
