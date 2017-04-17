<?php

namespace Revenda\CPanel;

use Revenda\Client\User;
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

    public function desativaConta(Conta $conta)
    {
        $rep = $this->xmlapi->suspendacct($conta->usuario);
        return (int)$rep->result->status;
    }

    public function reativaConta(Conta $conta)
    {
        $rep = $this->xmlapi->unsuspendacct($conta->usuario);
        return (int)$rep->result->status;
    }

    /**
     * @param User $user
     * @return mixed|string
     */
    public function criaNomeUsuario(User $user)
    {
        $i = 1;
        do {
            $username = strtolower(explode(' ', $user->nome)[0]);
            $aux = count($user->contas) + $i;
            $username = 'h'.$aux.$username;
            $username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
            $i++;
        } while(!$this->usernameIsValid($username));
        return $username;
    }

    /**
     * @param string $n
     * @return bool
     */
    private function usernameIsValid($n)
    {
        $existDB = Conta::where('usuario', $n)->first();
        if($existDB)
            return false;
        $existCP = $this->verificaNomeUsuario($n);
        if(!$existCP)
            return false;

        return true;
    }

    private function verificaNomeUsuario($usuario)
    {
        $rep = $this->xmlapi->verifyusername($usuario);
        //return ['codigo' => (int) $rep->metadata->result, 'mensagem' => (string) $rep->metadata->reason];
        return (int) $rep->metadata->result;

    }
}