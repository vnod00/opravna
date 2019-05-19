<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $primaryKey = 'ord_id';
    public $timestamps = true;
    public function task_user(){
        return $this->belongsToMany('App\User', 'task_done','ord_id', 'user_id');
    }
    public function task(){
        return $this->belongsToMany('App\Task', 'task_done','ord_id', 'task_id');
    }
    public function model(){
        return $this->belongsTo('App\DeviceModel', 'model_id');
    }
    public function customer(){
        return $this->belongsTo('App\Customer', 'cus_id');
    }
    public function repair(){
        return $this->belongsToMany('App\Repair', 'order_repair', 'ord_id', 'rep_id');
    }
}
