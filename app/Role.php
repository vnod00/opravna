<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //Table Name
     protected $table = 'roles';
    // Primary Key
    public $primaryKey = 'role_id';
    // Timestamps
    public $timestamps = true;  

    public function user(){
        return $this->hasMany('App\User', 'role_id');
    }
}
