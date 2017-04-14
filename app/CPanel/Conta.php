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

    /**
     * @return string
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Revenda\Client\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pacote()
    {
        return $this->belongsTo('Revenda\CPanel\Pacote','pacote_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagamentos()
    {
        return $this->hasMany('Revenda\Payment\Pagamento', 'conta_id', $this->primaryKey);
    }

    /**
     * @return string
     */
    public function routeNotificationForSlack()
    {
        return $this->slack_webhook_url;
    }

    /**
     * @return string
     */
    public function routeNotificationForMail()
    {
        return 'vinicius.fernandes.brito@gmail.com';
        //return $this->user->email;
    }


    /**
     * True if there was generated an invoice to next payday (prox_pagamento)
     * @return bool
     */
    public function temPagamento()
    {
        if(count($this->pagamentos) > 0) {
            $pgt = $this->pagamentos()->orderBy('data', 'desc')->first();
            if($pgt->data->format('Y-m-d') == $this->prox_pagamento->format('Y-m-d'))
                return true;
        }
        return false;
    }
}
