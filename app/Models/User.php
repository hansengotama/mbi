<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday_of_data',
        'phone_number',
        'role',
        'place_of_birth',
        'blood_type',
        'gender',
        'ktub_number'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function OauthAccessToken(){
        return $this->hasMany('\App\OauthAccessToken');
    }
}
