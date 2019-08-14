<?php

class PagueVeloz_Api_Model_Dto_EmitirBoletoDTO
{

    private $_vencimento;
    private $_valor;
    private $_seuNumero;
    private $_sacado;
    private $_cpfCnpjSacado;
    private $_parcela;
    private $_linha1;
    private $_linha2;
    private $_cpfCnpjCedente;
    private $_cedente;

    public function setVencimento($vencimento)
    {
        if (empty($vencimento))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento informado não deve ser NULL. \"$vencimento\" é null.");

        $this->_vencimento = $vencimento;
    }

    public function setValor($valor)
    {
        if (empty($valor))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento informado não deve ser NULL. \"$valor\" é null.");
        $valor *= 100;
        $this->_valor = $valor;
    }

    public function setSeuNumero($seuNumero)
    {
        if (empty($seuNumero))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento informado não deve ser NULL. \"$seuNumero\" é null.");

        $this->_seuNumero = $seuNumero;
    }

    public function setSacado($sacado)
    {
        if (empty($sacado))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento informado não deve ser NULL. \"$sacado\" é null.");

        $this->_sacado = $sacado;
    }

    public function setCpfCnpjSacado($cpfCnpjSacado)
    {
        if (empty($cpfCnpjSacado))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento informado não deve ser NULL. \"$cpfCnpjSacado\" é null.");

        $this->_cpfCnpjSacado = $cpfCnpjSacado;
    }

    public function setParcela($parcela)
    {
        $this->_parcela = $parcela;
    }

    public function setLinha1($linha1)
    {
        if (empty($linha1))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento informado não deve ser NULL. \"$linha1\" é null.");

        $this->_linha1 = $linha1;
    }

    public function setLinha2($linha2)
    {
        if (empty($linha2))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento informado não deve ser NULL. \"$linha2\" é null.");

        $this->_linha2 = $linha2;
    }

    public function setCpfCnpjCedente($cpfCnpjCedente)
    {
        if (empty($cpfCnpjCedente))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento informado não deve ser NULL. \"$cpfCnpjCedente\" é null.");

        $this->_cpfCnpjCedente = $cpfCnpjCedente;
    }

    public function setCedente($cedente)
    {
        if (empty($cedente))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento informado não deve ser NULL. \"$cedente\" é null.");

        $this->_cedente = $cedente;
    }

    public function getVencimento()
    {
        return $this->_vencimento;
    }

    public function getValor()
    {
        return $this->_valor;
    }

    public function getSeuNumero()
    {
        return $this->_seuNumero;
    }

    public function getSacado()
    {
        return $this->_sacado;
    }

    public function getCpfCnpjSacado()
    {
        return $this->_cpfCnpjSacado;
    }

    public function getParcela()
    {
        return $this->_parcela;
    }

    public function getLinha1()
    {
        return $this->_linha1;
    }

    public function getLinha2()
    {
        return $this->_linha2;
    }

    public function getCpfCnpjCedente()
    {
        return $this->_cpfCnpjCedente;
    }

    public function getCedente()
    {
        return $this->_cedente;
    }

}
