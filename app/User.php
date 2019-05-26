<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $attributes = [
        
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'role_id', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }

        /**
     * @param string|array $roles
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'Nemáte dostatečnou autorizaci.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'Nemáte dostatečnou autorizaci.');
    }
    /**
* Check multiple roles
* @param array $roles
*/
public function hasAnyRole($roles)
{
  return null !== $this->role()->whereIn('name', $roles)->first();
}
/**
* Check one role
* @param string $role
*/
public function hasRole($role)
{
  return null !== $this->role()->where('name', $role)->first();
}
public function task_order(){
    return $this->belongsToMany('App\Order', 'task_done');
}
    
}
