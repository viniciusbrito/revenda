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

    protected $fillable = ['codigo', 'referencia', 'status', 'conta_id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $hidden = ['idPagamento', 'conta_id', 'created_at', 'updated_at'];

    public function conta()
    {
        return $this->belongsTo('Revenda\CPanel\Conta', 'conta_id');
    }

    public function routeNotificationForSlack()
    {
        return $this->slack_webhook_url;
    }
}
