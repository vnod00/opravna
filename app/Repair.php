<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $table = 'repairs';
    public $primaryKey = 'rep_id';
    public $timestamps = true;

    public function order()
    {
        return $this->belongsToMany('App\Order','order_repair');
    }  
}
