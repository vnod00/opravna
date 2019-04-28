<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    public $primaryKey = 'cus_id';
    public $timestamps = true;

    /**
     * Get the comments for the blog post.
     */
    /*  public function model()
    {
        return $this->hasMany('App\DeviceModel');
    }  */
}
