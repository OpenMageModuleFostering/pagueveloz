<?php

class PagueVeloz_Api_Model_Dto_TransferenciaDTO
{

    private $_clienteDestino = '';
    private $_valor = '';
    private $_descricao = '';

    public function setClienteDestino(PagueVeloz_Api_Model_Dto_EmailDTO $clienteDestino)
    {
        if (empty($clienteDestino))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("O argumento \"clienteDestino\" é requirido. Não deve ser NULL ou vazio.");

        $this->_clienteDestino = $clienteDestino;
    }

    public function setValor($valor)
    {
        if (empty($valor))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("O argumento \"valor\" é requirido. Não deve ser NULL ou vazio.");

        if (!is_numeric($valor))
            throw new PagueVeloz_Api_Model_Exceptions_InvalidValueException("O argumento \"valor\" deve ser um valor numérico válido.");

        $this->_valor = $valor;
    }

    public function setDescricao($descricao)
    {
        if (empty($descricao))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("O argumento \"descricao\" é requerido. Não deve ser NULL ou vazio.");

        $this->_descricao = $descricao;
    }

    public function getClienteDestino()
    {
        return $this->_clienteDestino;
    }

    public function getValor()
    {
        return $this->_valor;
    }

    public function getDescricao()
    {
        return $this->_descricao;
    }

}
