<?php

namespace Revenda\CPanel;

use Revenda\CPanel\xmlapi;
use Revenda\CPanel\Conta;

class CPanel
{
    private $host;
    private $user;
    private $pass;
    private $xmlapi;

    private $conta;

    public function __construct($host,  $user, $pass)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;

        $this->xmlapi = new xmlapi($this->host);
        $this->xmlapi->password_auth($this->user,$this->pass);
        $this->xmlapi->set_debug(0);
    }

    /**
     * @param $conta
     */
    public function setConta(Conta $conta)
    {
        $this->conta = $conta;
    }

    /**
     * @return string
     */
    public function dominioPrincipal()
    {
        $resposta = (string) $this->xmlapi->api2_query($this->conta, 'DomainLookup', 'getmaindomain')->data->main_domain;
        return $resposta;
    }

    /**
     * @param $domain
     * @param $rootdomain
     * @return array
     */
    public function criarSubDominio($domain, $rootdomain)
    {
        $parametros = ['domain' => $domain, 'rootdomain' => $rootdomain];

        $resposta = $this->xmlapi->api2_query($this->conta, 'SubDomain', 'addsubdomain', $parametros);

        return ['codigo' => (int)$resposta->data->result, 'mensagem' => (string)$resposta->data->reason];
    }

    /**
     * @return array
     */
    public function listarSubDominios()
    {
        $resposta = (array) $this->xmlapi->api2_query($this->conta, 'SubDomain', 'listsubdomains');

        $array = (array) $resposta['data'];

        $result = isset($resposta['event']->result)? (int)$resposta['event']->result : 0;

        return $result? ['codigo' => 1,'dados' => $array] : ['codigo' => 0, 'mensagem' => $resposta['data']['reason']];
    }

    /**
     * @param $subDomain
     * @return array
     */
    public function removerSubDominio($subDomain)
    {
        $parametros = ['domain' => $subDomain];

        $resposta = $this->xmlapi->api2_query($this->conta, 'SubDomain', 'delsubdomain', $parametros);

        return ['codigo' => (int)$resposta->data->result, 'mensagem' => (string)$resposta->data->reason];
    }

    /**
     * @param $domain
     * @param $user
     * @param $password
     * @param $quota
     * @return array
     */
    public function criarEmail($domain, $user, $password, $quota)
    {
        $parametros = [
            'domain' => $domain,
            'email' => $user,
            'password' => $password,
            'quota' => $quota
        ];

        $resposta = $this->xmlapi->api2_query($this->conta, 'Email', 'addpop', $parametros);

        return ['codigo' => (int)$resposta->data->result, 'mensagem' => (string)$resposta->data->reason];
    }

    /**
     * @return array
     */
    public function listarEmails()
    {
        $resposta = (array) $this->xmlapi->api2_query($this->conta, 'Email', 'listpops');

        $array = (array) $resposta['data'];

        $result = isset($resposta['event']->result)? (int)$resposta['event']->result : 0;

        return $result? ['codigo' => 1,'dados' => $array] : ['codigo' => 0, 'mensagem' => $resposta['data']['reason']];
    }

    /**
     * @param $domain
     * @param $user
     * @param $password
     * @return array
     */
    public function mudarSenhaEmail($domain, $user, $password)
    {
        $parametros = [
            'domain' => $domain,
            'email' => $user,
            'password' => $password
        ];

        $resposta = $this->xmlapi->api2_query($this->conta, 'Email', 'passwdpop', $parametros);

        return ['codigo' => (int)$resposta->data->result, 'mensagem' => (string)$resposta->data->reason];
    }

    /**
     * @param $domain
     * @param $user
     * @return array
     */
    public function removerEmail($domain, $user)
    {
        $parametros = [
            'domain' => $domain,
            'email' => $user
        ];

        $resposta = $this->xmlapi->api2_query($this->conta, 'Email', 'delpop', $parametros);

        return ['codigo' => (int)$resposta->data->result, 'mensagem' => (string)$resposta->data->reason];
    }


    /**
     * @param $database
     */
    public function criarMySQLDB($database)
    {
        $parametros = ['db' => $this->conta.'_'.$database];

        $resposta = $this->xmlapi->api2_query($this->conta, 'MysqlFE', 'createdb', $parametros);

        if((int)$resposta->data)
            return ['codigo' => (int)$resposta->data, 'mensagem' => 'OK'];
        else
            return ['codigo' => (int)$resposta->data->result, 'mensagem' => (string)$resposta->data->reason];
    }

    /**
     * @param $database
     */
    public function removerMySQLDB($database)
    {
        $parametros = ['db' => $database];

        $resposta = $this->xmlapi->api2_query($this->conta, 'MysqlFE', 'deletedb', $parametros);

        if((int)$resposta->data)
            return ['codigo' => (int)$resposta->data, 'mensagem' => 'OK'];
        else
            return ['codigo' => (int)$resposta->data->result, 'mensagem' => (string)$resposta->data->reason];
    }

    /**
     *
     */
    public function listarMySQLDBs()
    {
        $resposta = (array) $this->xmlapi->api2_query($this->conta, 'MysqlFE', 'listdbs');

        $array = isset($resposta['data'])? (array) $resposta['data'] : [];

        $result = isset($resposta['event']->result)? (int)$resposta['event']->result : 0;

        return $result? ['codigo' => 1,'dados' => $array] : ['codigo' => 0, 'mensagem' => $resposta['data']['reason']];
    }
}