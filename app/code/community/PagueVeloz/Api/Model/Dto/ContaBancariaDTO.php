<?php

class PagueVeloz_Api_Model_Dto_ContaBancariaDTO
{

    private $_id = '';
    private $_banco = '';
    private $_agencia = '';
    private $_conta = '';
    private $_descricao = '';

    public function setId($id)
    {
        if (empty($id))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento \"id\" não deve ser NULL");
        $this->_id = $id;
    }

    public function setBanco($banco)
    {
        if (empty($banco))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("O argumento \"Banco\" está NULL ou vazio.");

        $this->_banco = $banco;
    }

    public function setAgencia($agencia)
    {
        if (empty($agencia))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("O argumento \"Agencia\" está NULL ou vazio.");

        $this->_agencia = $agencia;
    }

    public function setConta($conta)
    {
        if (empty($conta))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("O argumento \"Conta\" está NULL ou vazio.");

        $this->_conta = $conta;
    }

    public function setDescricao($descricao)
    {
        if (empty($descricao))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento \"Descrição\" não pode ser NULL ou vazio.");

        $this->_descricao = $descricao;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getBanco()
    {
        return $this->_banco;
    }

    public function getAgencia()
    {
        return $this->_agencia;
    }

    public function getConta()
    {
        return $this->_conta;
    }

    public function getDescricao()
    {
        return $this->_descricao;
    }

}
