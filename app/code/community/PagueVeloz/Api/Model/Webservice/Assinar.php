<?php

class PagueVeloz_Api_Model_Webservice_Assinar extends PagueVeloz_Api_Model_Webservice_PagueVeloz
{

    private $_default_header = 'Content-Type: application/json';

    public function __construct()
    {
        parent::__construct('api/v2/Assinar');
    }

    public function Post(PagueVeloz_Api_Model_Dto_AssinarDTO $dto)
    {
        $contexto = new PagueVeloz_Api_Model_Common_HttpContext();
        $contexto->setMethod('post');
        $contexto->addHeader($this->_default_header);
        $contexto->setHost($this->getHost());

        $json = array(
            "Endereco" => array(
                "Cidade" => array(
                    "Nome" => $dto->getCidade(),
                    "Estado" => $dto->getEstado()
                ),
                "Logradouro" => $dto->getRua(),
                "Numero" => $dto->getNumero(),
                "CEP" => $dto->getCep()
            ),
            "Nome" => $dto->getNome(),
            "Documento" => $dto->getDocumento(),
            "TipoPessoa" => $dto->getTipoPessoa(),
            "Email" => $dto->getEmail(),
            "LoginUsuarioDefault" => $dto->getLoginUsuarioDefault(),
            //"UrlNotificacao" => '',
            //"Id" => 6
        );
        $json = json_encode($json);

        $contexto->setBody($json);

        return $this->getMachine()->Send($contexto);
    }

}
