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
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeActive($query) {
        return $query->where('is_active', 1);
    }

    public function scopeDeleted($query) {
        return $query->where('is_active', 0);
    }

    public function comments() {
        return $this->hasMany('App\ContentComment', 'id', 'user_id');
    }

    public function replies() {
        return $this->hasMany('App\CommentReply', 'id', 'user_id');
    }

    public function orders() {
        return $this->hasMany('App\ShopItemOrder', 'id', 'user_id');
    }

}
