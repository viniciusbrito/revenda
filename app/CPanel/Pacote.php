<?php

namespace Revenda\CPanel;

use Illuminate\Database\Eloquent\Model;

class Pacote extends Model
{
    protected $fillable = [
        'nome', 'periodo', 'valor'
    ];

    protected $hidden = ['periodo'];

    public $timestamps = false;

    protected $table = 'pacotes';

    protected $primaryKey = 'idPacote';

    public function contas()
    {
        return $this->hasMany('Revenda\CPanel\Conta', 'pacote_id', $this->primaryKey);
    }
}
