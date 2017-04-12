<?php

namespace Revenda\Client;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['nome', 'email', 'cpf', 'telefone', 'password'];

    protected $dates = ['created_at', 'updated_at'];

    protected $hidden = ['id', 'password', 'remember_token', 'created_at', 'updated_at'];

    public function contas()
    {
        return $this->hasMany('Revenda\CPanel\Conta', 'user_id');
    }

    public function endereco()
    {
        return $this->hasOne('Revenda\Client\Endereco', 'user_id');
    }

    /*
     * Mutator to get only telefone number
     */
    public function getTelefoneAttribute()
    {
        return explode(' ', $this->attributes['telefone'])[1];
    }

    /*
     * Mutator to get telefone codigo area
     */
    public function getCodigoAreaAttribute()
    {
        return explode(' ', $this->attributes['telefone'])[0];
    }
}
