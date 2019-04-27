<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $primaryKey = 'ord_id';
    public $timestamps = true;
}
