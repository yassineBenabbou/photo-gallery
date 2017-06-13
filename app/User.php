<?php

namespace App;

use Storage;
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
        'name', 'email', 'password','provider','provider_id', 'avatar'
    ];

    public static $avatarFolder = 'public/avatars';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() {

        return $this->admin ? true : false;
    }

    public function comments() {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    public function avatar() {
        return Storage::url(User::$avatarFolder.'/'.$this->avatar);
    }
}

