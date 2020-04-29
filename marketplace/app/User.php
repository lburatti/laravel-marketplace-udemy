<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', // esconde essas informações
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // define o tipo para esse campo, neste caso datetime
    ];

    public function store()
    {
        return $this->hasOne(Store::class, 'user_id');
    }

    public function orders() 
    {
        return $this->hasMany(UserOrders::class);
    }

    public function routeNotificationForNexmo($notification)
    {
        $storeMobilePhoneNumber = trim(str_replace(['(', ')', ' ', '-'], '', $this->store->mobile_phone));
        return '55'.$storeMobilePhoneNumber;
    }
}
