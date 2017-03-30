<?php

namespace Revenda\Payment;

use Illuminate\Database\Eloquent\Model;
use Log;
use Revenda\Client\User;
use Revenda\CPanel\Conta;

class Pagseguro extends Model
{
    public function __construct()
    {
        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
        \PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");
    }

    public function criaPagamentoBoleto(User $user, Conta $conta, $hash)
    {
        $boleto = new \PagSeguro\Domains\Requests\DirectPayment\Boleto();
        $boleto->setMode('DEFAULT');
        $boleto->setCurrency("BRL");
        $boleto->addItems()->withParameters(
            (string) $conta->pacote->idPacote,
            $conta->pacote->nome,
            1,
            (float)$conta->pacote->valor
        );
        $boleto->setReference("LIBPHP000001-boleto");
        $boleto->setSender()->setName($user->nome);
        $boleto->setSender()->setEmail($user->email);
        $boleto->setSender()->setDocument()->withParameters('CPF', $user->cpf);

        $boleto->setSender()->setPhone()->withParameters(66, 992399414);

        $boleto->setShipping()->setAddress()->withParameters(
            $user->endereco->rua,
            $user->endereco->numero,
            $user->endereco->bairro,
            $user->endereco->cep,
            $user->endereco->cidade,
            $user->endereco->estado,
            'BRA',
            $user->endereco->ponto_referencia
        );

        $boleto->setSender()->setHash($hash);

        try {
            $credential = \PagSeguro\Configuration\Configure::getAccountCredentials();
            return $boleto->register($credential);
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function criaPagamentoCheckout()
    {
        $payment = new \PagSeguro\Domains\Requests\Payment();
        $payment->setCurrency("BRL");
        $payment->setReference("BLT001");
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

    public function criaAssinatura(Conta $conta)
    {
        $preApproval = new \PagSeguro\Domains\Requests\PreApproval();
        $preApproval->setCurrency("BRL");
        $preApproval->setRedirectUrl(route('redirect'));
        $preApproval->setReviewUrl("http://cpanel-api.app/review/");
        $preApproval->setPreApproval()->setCharge('auto');
        $preApproval->setReference("REF123");

        $preApproval->setSender()->setName($conta->nome);
        $preApproval->setSender()->setEmail($conta->email);
        $preApproval->setSender()->setPhone()->withParameters(11, 56273440);

        $preApproval->setPreApproval()->setName($conta->pacote->nome);

        if($conta->pacote->periodo == 'MONTHLY')
            $preApproval->setPreApproval()->setDetails("Assinatura do plano Basico de cobrança mensal.");
        elseif($conta->pacote->periodo == 'TRIMONTHLY')
            $preApproval->setPreApproval()->setDetails("Assinatura do plano Basico de cobrança trimestral.");
        elseif($conta->pacote->periodo == 'YEARLY')
            $preApproval->setPreApproval()->setDetails("Assinatura do plano Basico de cobrança anual.");

        $preApproval->setPreApproval()->setAmountPerPayment($conta->pacote->valor);
        $preApproval->setPreApproval()->setPeriod($conta->pacote->periodo);

        try {

            return $response = $preApproval->register(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
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

    public function notificacao($tipo = null)
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
