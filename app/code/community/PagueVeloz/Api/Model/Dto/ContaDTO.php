<?php

class PagueVeloz_Api_Model_Dto_ContaDTO
{
    protected $valor;
    protected $titulo;
    protected $nomeTitulo;
    protected $vencimento;
    protected $codigoDeBarras;
    protected $id;

    /**
     * @return mixed
     */
    public function getCodigoDeBarras()
    {
        return $this->codigoDeBarras;
    }

    /**
     * @param mixed $codigoDeBarras
     */
    public function setCodigoDeBarras($codigoDeBarras)
    {
        $this->codigoDeBarras = $codigoDeBarras;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNomeTitulo()
    {
        return $this->nomeTitulo;
    }

    /**
     * @param mixed $nomeTitulo
     */
    public function setNomeTitulo($nomeTitulo)
    {
        $this->nomeTitulo = $nomeTitulo;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @return mixed
     */
    public function getVencimento()
    {
        return $this->vencimento;
    }

    /**
     * @param mixed $vencimento
     */
    public function setVencimento($vencimento)
    {
        $this->vencimento = $vencimento;
    }

}