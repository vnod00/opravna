<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    public $primaryKey = 'cus_id';
    public $timestamps = true;

     public function order()
    {
        return $this->hasMany('App\Order', 'cus_id');
    }  
}
