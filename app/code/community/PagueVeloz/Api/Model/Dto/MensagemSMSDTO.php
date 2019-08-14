<?php

class PagueVeloz_Api_Model_Dto_MensagemSMSDTO
{

    private $seuId;
    private $telefoneRemetente;
    private $telefoneDestino;
    private $conteudo;
    private $agendarPara;

    public function getSeuId()
    {
        return $this->seuId;
    }

    public function getTelefoneRemetente()
    {
        return $this->telefoneRemetente;
    }

    public function getTelefoneDestino()
    {
        return $this->telefoneDestino;
    }

    public function getConteudo()
    {
        return $this->conteudo;
    }

    public function getAgendarPara()
    {
        if (!$this->agendarPara) {
            $this->agendarPara = date('c');
        }

        return $this->agendarPara;
    }

    public function setSeuId($seuId)
    {
        $this->seuId = $seuId;
    }

    public function setTelefoneRemetente($telefoneRemetente)
    {
        $this->telefoneRemetente = $telefoneRemetente;
    }

    public function setTelefoneDestino($telefoneDestino)
    {
        $this->telefoneDestino = $telefoneDestino;
    }

    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }

    public function setAgendarPara($agendarPara)
    {
        $this->agendarPara = $agendarPara;
    }



}
