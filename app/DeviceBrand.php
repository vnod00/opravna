<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceBrand extends Model
{
    protected $table = 'device_brands';
    public $primaryKey = 'brand_id';
    public $timestamps = true;

    /**
     * Get the comments for the blog post.
     */
     public function model()
    {
        return $this->hasMany('App\DeviceModel', 'brand_id');
    } 
}
