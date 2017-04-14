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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contas()
    {
        return $this->hasMany('Revenda\CPanel\Conta', 'pacote_id', $this->primaryKey);
    }

    /**
     * @return string
     */
    public function getPeriodoAttribute()
    {
        switch($this->attributes['periodo']) {
            case 'MONTHLY':
                return 'Mensal';
                break;
            case 'TRIMONTHLY':
                return 'Trimestral';
                break;
            case 'YEARLY':
                return 'Anual';
                break;
        }
    }
}
