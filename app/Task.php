<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
        //Table Name
        protected $table = 'tasks';
        // Primary Key
        public $primaryKey = 'task_id';
        // Timestamps
        public $timestamps = true;  
    
        public function task_order(){
            return $this->belongsToMany('App\Order', 'task_done');
        }
}
