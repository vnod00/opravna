<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    protected $table = 'device_models';
    public $primaryKey = 'id';
    public $timestamps = true;

     public function brand()
    {
        return $this->belongsTo('App\DeviceBrand', 'brand_id');
    } 
    public function order()
    {
        return $this->hasMany('App\Order', 'ord_id');
    }
}
