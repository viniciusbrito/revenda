<?php

namespace Revenda\CPanel;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $fillable = [
        'dominio', 'usuario', 'senha', 'status_id', 'pacote_id'
    ];

    protected $hidden = [
        'idConta', 'senha', 'pacote_id', 'nova_conta', 'created_at', 'updated_at'
    ];

    protected $table = 'contas';

    protected $primaryKey = 'idConta';

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('Revenda\Client\User', 'user_id');
    }

    public function pacote()
    {
        return $this->belongsTo('Revenda\CPanel\Pacote','pacote_id');
    }

    public function status()
    {
        switch ($this->status_id) {
            case 1:
                return 'No Carrinho';
            case 2:
                return 'Aguardando pagamento';
            case 3:
                return 'Ativo';
            case 4:
                return 'Inativo';
        }
    }

    public function pagamentos()
    {
        return $this->hasMany('Revenda\Payment\Pagamento', 'conta_id', $this->primaryKey);
    }
}
