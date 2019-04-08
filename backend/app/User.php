<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','cin', 'driving_license_number', 'address', 'telephone','role', 'status', 'city_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $assigns = ['image'];
    // Custom Model Methods 

    /*
     * User Relationship with Image
     * 
     * @return Image related to this user
     * 
     */ 
    public function image(){
        return $this->hasOne('\App\Image');
    }

    /*
     * Get User Cars 
     * 
     * @return \App\Car
     * 
     */ 
    public function cars(){
        return $this->hasMany('\App\Car');  
    }

    /*
     * Verify User role
     * 
     * @param String 
     * 
     * @return boolean
     * 
     */ 
    public function hasRole($role){
        if(strtolower($this->role) == strtolower($role)){
            return true;
        }
        return false;
    }


    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
