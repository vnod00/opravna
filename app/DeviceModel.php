<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    protected $table = 'device_models';
    public $primaryKey = 'model_id';
    public $timestamps = true;

     public function brand()
    {
        return $this->belongsTo('App\DeviceBrand','brand_id', 'brand_id');
    } 
}
