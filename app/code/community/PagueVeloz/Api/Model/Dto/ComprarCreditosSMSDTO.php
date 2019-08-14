<?php

class PagueVeloz_Api_Model_Dto_ComprarCreditosSMSDTO
{

    private $_creditos;
    private $_formaPgto = 1;

    public function setCreditos($creditos)
    {
        if (empty($creditos)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("O argumento \"creditos\" passado está NULL. \"$creditos\" é null.");
        }

        $this->_creditos = $creditos;
    }

    public function setValor($valor)
    {
        if (empty($valor)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("O argumento \"valor\" passado está NULL. \"$valor\" é null.");
        }

        $this->_valor = $valor;
    }

    public function setFormaPgto($formaPgto)
    {
        $this->_formaPgto = $formaPgto;
    }

    public function getCreditos()
    {
        return $this->_creditos;
    }

    public function getValor()
    {
        return $this->_valor;
    }

    public function getFormatPto()
    {
        return $this->_formaPgto;
    }

}
