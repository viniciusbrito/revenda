<?php

namespace Revenda\Payment;


use Revenda\Client\User;
use Revenda\CPanel\Conta;

class PagseguroBoleto extends Pagseguro
{

    protected $boleto;

    function __construct()
    {
        parent::__construct();
        $this->boleto = new \PagSeguro\Domains\Requests\DirectPayment\Boleto();
        $this->boleto->setMode('DEFAULT');
        $this->boleto->setCurrency("BRL");
        $this->reference = 'BLT-'.$this->reference;
    }

    public function gerar(User $user, Conta $conta, $hash)
    {
        $this->boleto->addItems()->withParameters(
            (string) $conta->pacote->idPacote,
            $conta->pacote->nome,
            1,
            (float)$conta->pacote->valor
        );
        $this->boleto->setReference($this->reference);
        $this->boleto->setSender()->setName($user->nome);
        $this->boleto->setSender()->setEmail($user->email);
        $this->boleto->setSender()->setDocument()->withParameters('CPF', $user->cpf);

        $this->boleto->setSender()->setPhone()->withParameters($user->codigo_area, $user->telefone);

        $this->boleto->setShipping()->setAddress()->withParameters(
            $user->endereco->logradouro,
            $user->endereco->numero,
            $user->endereco->bairro,
            $user->endereco->cep,
            $user->endereco->cidade,
            $user->endereco->estado,
            'BRA',
            $user->endereco->complemento
        );

        $this->boleto->setSender()->setHash($hash);

        try {
            $credential = \PagSeguro\Configuration\Configure::getAccountCredentials();
            return $this->boleto->register($credential);
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function buscar($code = null)
    {
        if($code) {

            try {
                return  \PagSeguro\Services\Transactions\Search\Code::search(
                    \PagSeguro\Configuration\Configure::getAccountCredentials(),
                    $code
                );
            }
            catch(Exception $e) {
                Log::error($e->getMessage());
                return false;
            }
        }
        return false;

    }

    public function notificacao()
    {
        try {
            if (\PagSeguro\Helpers\Xhr::hasPost()) {
                $response = \PagSeguro\Services\Transactions\Notification::check(
                    \PagSeguro\Configuration\Configure::getAccountCredentials()
                );
                return $response;
            }
            else {
                throw new \InvalidArgumentException($_POST);
            }
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
