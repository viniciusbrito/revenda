<?php

namespace Revenda\Payment;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $table = 'pagamentos';

    protected $primaryKey = 'idPagamento';

    protected $fillable = ['codigo', 'referencia', 'status', 'conta_id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $hidden = ['idPagamento', 'conta_id', 'created_at', 'updated_at'];

    public function conta()
    {
        return $this->belongsTo('Revenda\CPanel\Conta', 'conta_id');
    }
}
