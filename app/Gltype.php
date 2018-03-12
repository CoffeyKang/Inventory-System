<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gltype extends Model
{
    protected $table = 'gltype';

    protected $primaryKey = 'gltype';

    public $incrementing = false;

    public $timestamps =false;

    protected $fillable = ['gldesc','glseq','gllow','glupp'];
}
