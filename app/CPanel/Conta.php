<?php

namespace Revenda\CPanel;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $fillable = [
        'dominio', 'usuario', 'senha', 'pacote_id'
    ];

    protected $hidden = [
        'idConta', 'senha', 'pacote_id', 'nova_conta', 'created_at', 'updated_at'
    ];

    protected $table = 'contas';

    protected $primaryKey = 'idConta';

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];

    public function usuario()
    {
        return $this->belongsTo('Revenda\Client\User', 'user_id');
    }

    public function pacote()
    {
        return $this->belongsTo('Revenda\CPanel\Pacote','pacote_id');
    }
}
