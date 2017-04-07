<?php

namespace Revenda\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pagamento extends Model
{
    use Notifiable;

    private $slack_webhook_url = 'https://hooks.slack.com/services/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';

    protected $table = 'pagamentos';

    protected $primaryKey = 'idPagamento';

    protected $fillable = ['codigo', 'referencia', 'status', 'data', 'conta_id'];

    protected $dates = ['created_at', 'updated_at', 'data'];

    protected $hidden = ['idPagamento', 'conta_id', 'created_at', 'updated_at'];

    public function conta()
    {
        return $this->belongsTo('Revenda\CPanel\Conta', 'conta_id');
    }

    public function status()
    {
        switch ($this->status) {
            case 1:
                return 'Aguardando pagamento';
            case 2:
                return 'Em análise';
            case 3:
                return 'Paga';
            case 4:
                return 'Disponível';
            case 5:
                return 'Em disputa';
            case 6:
                return 'Devolvida';
            case 7:
                return 'Cancelada';
        }
    }

    public function routeNotificationForSlack()
    {
        return $this->slack_webhook_url;
    }

    public function routeNotificationForMail()
    {
        return 'vinicius.fernandes.brito@gmail.com';
        //return $this->conta->user->email;
    }
}
