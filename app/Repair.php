<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $table = 'repairs';
    public $primaryKey = 'rep_id';
    public $timestamps = true;

     /* public function brand()
    {
        return $this->belongsTo('App\DeviceBrand','brand_id', 'brand_id');
    }  */
}
