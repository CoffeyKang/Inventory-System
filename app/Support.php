<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    //
    protected $table='arisup01';

    protected $fillable = ['ytdqty','cost','onorder','lrecdate'];

    public $timestamps = false;
}