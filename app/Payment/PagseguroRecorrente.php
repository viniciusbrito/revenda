<?php

namespace Revenda\Payment;


use Revenda\Client\User;
use Revenda\CPanel\Conta;

class PagseguroRecorrente extends Pagseguro
{
    protected $preApproval;

    function __construct()
    {
        parent::__construct();
        $this->preApproval = new \PagSeguro\Domains\Requests\DirectPayment\Boleto();
        $this->preApproval->setMode('DEFAULT');
        $this->preApproval->setCurrency("BRL");
    }

    public function gerar(User $user, Conta $conta)
    {
        $this->preApproval = new \PagSeguro\Domains\Requests\PreApproval();
        $this->preApproval->setCurrency("BRL");
        $this->preApproval->setRedirectUrl(route('redirect'));
        $this->preApproval->setReviewUrl("http://cpanel-api.app/review/");
        $this->preApproval->setPreApproval()->setCharge('auto');
        $this->preApproval->setReference($this->reference);

        $this->preApproval->setSender()->setName($conta->nome);
        $this->preApproval->setSender()->setEmail($conta->email);
        $this->preApproval->setSender()->setPhone()->withParameters(11, 56273440);

        $this->preApproval->setPreApproval()->setName($conta->pacote->nome);

        if($conta->pacote->periodo == 'MONTHLY')
            $this->preApproval->setPreApproval()->setDetails("Assinatura do plano Basico de cobrança mensal.");
        elseif($conta->pacote->periodo == 'TRIMONTHLY')
            $this->preApproval->setPreApproval()->setDetails("Assinatura do plano Basico de cobrança trimestral.");
        elseif($conta->pacote->periodo == 'YEARLY')
            $this->preApproval->setPreApproval()->setDetails("Assinatura do plano Basico de cobrança anual.");

        $this->preApproval->setPreApproval()->setAmountPerPayment($conta->pacote->valor);
        $this->preApproval->setPreApproval()->setPeriod($conta->pacote->periodo);

        try {

            return $response = $this->preApproval->register(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
