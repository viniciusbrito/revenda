<?php

namespace Revenda\Client;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function contas()
    {
        return $this->hasMany('Revenda\CPanel\Conta', 'user_id');
    }
}
