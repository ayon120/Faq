<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
{
    return $this->belongsToMany('App\Role');
}


public function hasAnyRoles($roles)
{



if($this->roles()->whereIn('name',$roles)->first())
{
 return true;
}

else return false;



}

public function hasAnyRole($role)
{
    return null !== $this->roles()->whereIn('name', $role)->first();


}
//bhhhhhhhhhh
public function hasRole($role)
{
 if( $this->roles()->where('name',$role)->first()){

    return true;
 }
 else return false;

}




}

