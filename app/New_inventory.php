<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class New_inventory extends Model
{
    protected $table = 'inventory_8';

    protected $primaryKey = 'item';

    public $timestamps = false;

    public $incrementing = false;
}
