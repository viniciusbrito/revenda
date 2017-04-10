<?php

namespace Revenda\CPanel;

use Revenda\CPanel\xmlapi;
use Revenda\CPanel\Conta;

class WHM
{
    private $host;
    private $user;
    private $pass;
    private $xmlapi;

    public function __construct($host,  $user, $pass)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;

        $this->xmlapi = new xmlapi($this->host);
        $this->xmlapi->password_auth($this->user,$this->pass);
        $this->xmlapi->set_debug(0);
    }

    public function listarContas()
    {
        $r = (array)$this->xmlapi->listaccts();
        return $r['acct'];
    }

    public function listaPacotes()
    {
        $response =  $this->xmlapi->listpkgs();
        foreach($response->package as $pacote) {
            $p[] = (string)$pacote->name;
        }
        return $p;
    }

    public function listaOpcoes()
    {
        return (array) $this->xmlapi->applist()->app;
    }

    public function criaConta(Conta $conta)
    {
        $novaConta = [
            'username' => $conta->usuario,
            'password' => $conta->senha,
            'domain' => $conta->dominio,
            'contactemail' => $conta->user->email,
            'plan' => $conta->pacote->nome,
        ];
        $rep = $this->xmlapi->createacct($novaConta);
        return ['codigo' => (string)$rep->result->status, 'mensagem' => (string)$rep->result->statusmsg];
    }
}