<?php

namespace Revenda\Client;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';

    protected $primaryKey = 'idEndereco';

    public $timestamps = false;

    protected $fillable = [
        'rua',
        'numero',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'ponto_referencia',
        'user_id'
    ];

    protected $hidden = ['idEndereco', 'user_id'];

    public function usuario()
    {
        return $this->belongsTo('Revenda\Client\User', 'user_id');
    }
}
