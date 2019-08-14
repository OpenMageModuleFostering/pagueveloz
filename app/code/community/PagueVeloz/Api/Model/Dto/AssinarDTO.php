<?php

class PagueVeloz_Api_Model_Dto_AssinarDTO
{

    private $_nome = '';
    private $_documento = '';
    private $_tipoPessoa = '';
    private $_email = '';
    private $_loginUsuarioDefault = '';
    private $estado = '';
    private $cidade = '';
    private $rua = '';
    private $cep = '';
    private $numero = '';

    public function getEstado()
    {
        return $this->estado;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getRua()
    {
        return $this->rua;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function setRua($rua)
    {
        $this->rua = $rua;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setNome($nome)
    {
        if (empty($nome)) {
            throw new Exception("$nome vazio");
        }

        $this->_nome = $nome;
    }

    public function setDocumento($documento)
    {
        $this->_documento = $documento;
    }

    public function setTipoPessoa($tipoPessoa)
    {
        $this->_tipoPessoa = $tipoPessoa;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function setLoginUsuarioDefault($loginUsuarioDefault)
    {
        $this->_loginUsuarioDefault = $loginUsuarioDefault;
    }

    public function getNome()
    {
        return $this->_nome;
    }

    public function getDocumento()
    {
        return $this->_documento;
    }

    public function getTipoPessoa()
    {
        return $this->_tipoPessoa;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getLoginUsuarioDefault()
    {
        return $this->_loginUsuarioDefault;
    }

}
