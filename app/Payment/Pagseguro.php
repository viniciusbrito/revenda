<?php

namespace Revenda\Payment;

use Log;
use Revenda\Client\User;
use Revenda\CPanel\Conta;

class Pagseguro
{
    protected $reference;

    public function __construct()
    {
        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
        \PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

        $this->reference = random_int(100, 9999);
    }

    public function gerarCheckout(User $user, Conta $conta)
    {
        $payment = new \PagSeguro\Domains\Requests\Payment();
        $payment->setCurrency("BRL");
        $payment->setReference($this->reference);
        $payment->setRedirectUrl("http://cpanel-api.app/redirect");

        $payment->addItems()->withParameters(
            1,
            'Básico - Mensal',
            1,
            6.50
        );

// Set your customer information.
        $payment->setSender()->setName('João Comprador');
        $payment->setSender()->setEmail('email@sandbox.pagseguro.com.br');
        $payment->setSender()->setDocument()->withParameters(
            'CPF',
            '02218146126'
        );


//Add installments with no interest
        $payment->addPaymentMethod()->withParameters(
            \PagSeguro\Enum\PaymentMethod\Group::CREDIT_CARD,
            \PagSeguro\Enum\PaymentMethod\Config\Keys::MAX_INSTALLMENTS_LIMIT,
            1 // (int) qty of installment
        );

// Add a group and/or payment methods name
        $payment->acceptPaymentMethod()->groups(
            \PagSeguro\Enum\PaymentMethod\Group::CREDIT_CARD,
            \PagSeguro\Enum\PaymentMethod\Group::BALANCE,
            \PagSeguro\Enum\PaymentMethod\Group::BOLETO
        );
        $payment->acceptPaymentMethod()->name(\PagSeguro\Enum\PaymentMethod\Name::DEBITO_BANCO_BRASIL);
// Remove a group and/or payment methods name
        //$payment->excludePaymentMethod()->group(\PagSeguro\Enum\PaymentMethod\Group::BOLETO);


        try {

            /**
             * @todo For checkout with application use:
             * \PagSeguro\Configuration\Configure::getApplicationCredentials()
             *  ->setAuthorizationCode("FD3AF1B214EC40F0B0A6745D041BF50D")
             */
            $result = $payment->register(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function buscaAssinatura($code = null)
    {
        if($code) {

            try {
                return $response = \PagSeguro\Services\PreApproval\Search\Code::search(
                    \PagSeguro\Configuration\Configure::getAccountCredentials(),
                    $code
                );
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return false;
            }

        }
    }

    public function notificacoes($tipo = null)
    {
        switch($tipo) {

            case 'preApproval':
                return $this->notificacaoAssinatura();
                break;

            case 'transaction':
                return $this->notificacaoTransacao();
                break;

            default:
                return false;
        }

    }

    private function notificacaoAssinatura()
    {
        try {
            if (\PagSeguro\Helpers\Xhr::hasPost()) {
                $response = \PagSeguro\Services\PreApproval\Notification::check(
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

    private function notificacaoTransacao()
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

    private function notificacaoAutorizacao()
    {
        try {
            if (\PagSeguro\Helpers\Xhr::hasPost()) {
                $response = \PagSeguro\Services\Application\Notification::check(
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
