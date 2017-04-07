<?php

namespace Revenda\CPanel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Conta extends Model
{
    use Notifiable;

    private $slack_webhook_url = 'https://hooks.slack.com/services/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';

    protected $fillable = ['dominio', 'usuario', 'senha', 'status_id', 'pacote_id', 'prox_pagamento'];

    protected $hidden = ['idConta', 'senha', 'pacote_id', 'nova_conta', 'created_at', 'updated_at'];

    protected $table = 'contas';

    protected $primaryKey = 'idConta';

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at', 'prox_pagamento'];

    public function status()
    {
        switch ($this->status_id) {
            case 1:
                return 'Aguardando Pagamento';
            case 2:
                return 'Ativo';
            case 3:
                return 'Inativo';
            case 4:
                return 'Pagamento Atrasado';
        }
    }

    public function user()
    {
        return $this->belongsTo('Revenda\Client\User', 'user_id');
    }

    public function pacote()
    {
        return $this->belongsTo('Revenda\CPanel\Pacote','pacote_id');
    }

    public function pagamentos()
    {
        return $this->hasMany('Revenda\Payment\Pagamento', 'conta_id', $this->primaryKey);
    }

    public function routeNotificationForSlack()
    {
        return $this->slack_webhook_url;
    }

    public function routeNotificationForMail()
    {
        return 'vinicius.fernandes.brito@gmail.com';
        //return $this->user->email;
    }
}
