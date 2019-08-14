<?php

class PagueVeloz_Api_Model_Dto_SaqueDTO
{

    private $_id = '';
    private $_valor = '';

    public function setId($id)
    {
        if (empty($id))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("O argumento \"id\" é requirido. Não deve ser NULL ou vazio.");

        $this->_id = $id;
    }

    public function setValor($valor)
    {
        if (empty($valor))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("O argumento \"valor\" é requirido. Não deve ser NULL ou vazio.");

        if (!is_numeric($valor))
            throw new PagueVeloz_Api_Model_Exceptions_InvalidValueException("O argumento \"valor\" deve ser um valor numérico válido.");

        $this->_valor = $valor;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getValor()
    {
        return $this->_valor;
    }

}
