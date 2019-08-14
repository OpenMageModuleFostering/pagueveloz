<?php

class PagueVeloz_Api_Model_Webservice_Boleto extends PagueVeloz_Api_Model_Webservice_PagueVeloz
{

    private $_default_header = 'Content-Type: application/json';
    private $_authDto;

    public function __construct(PagueVeloz_Api_Model_Dto_EmailDTO $email, $token)
    {
        $machine = null;
        $this->setAuthDto(new PagueVeloz_Api_Model_Dto_AuthenticationDTO($email->getEmail(), $token));

        parent::__construct('api/v3/Boleto', $this->getAuthDto(), $machine);
    }

    public function Get(PagueVeloz_Api_Model_Dto_BoletoDTO $dto)
    {
        $contexto = Mage::getModel('pagueveloz_api/common_httpContext');
        $contexto->setMethod('get');
        $contexto->addHeader($this->_default_header);
        $contexto->setAuthorization($this->getAuthDto()->getEmail(), $this->getAuthDto()->getToken());
        $contexto->setHost($this->getHost() . '?SeuNumero=' . $dto->getSeuNumero());

        return $this->getMachine()->Send($contexto);
    }

    public function Post(PagueVeloz_Api_Model_Dto_BoletoDTO $dto)
    {
        $contexto = Mage::getModel('pagueveloz_api/common_httpContext');
        $contexto->setMethod('post');
        $contexto->addHeader($this->_default_header);
        $contexto->setAuthorization($this->getAuthDto()->getEmail(), $this->getAuthDto()->getToken());
        $contexto->setHost($this->getHost());
        $json = array(
            "Pdf"   => $dto->getPdf(),
            "Vencimento" => $dto->getVencimento(),
            "Valor" => $dto->getValor(),
            "SeuNumero" => $dto->getSeuNumero(),
            "Sacado" => $dto->getSacado(),
            "CPFCNPJSacado" => $dto->getCpfCnpjSacado(),
            "Parcela" => $dto->getParcela(),
            "Linha1" => $dto->getLinha1(),
            "Linha2" => $dto->getLinha2(),
            "CPFCNPJCedente" => $dto->getCpfCnpjCedente(),
            "Cedente" => $dto->getCedente()
        );

        if ($dto->getEmail()) {
            $json['Email'] = $dto->getEmail();
        }

        $json = json_encode($json);

        $contexto->setBody($json);
        return $this->getMachine()->Send($contexto);
    }

    public function setAuthDto(PagueVeloz_Api_Model_Dto_AuthenticationDTO $authDto)
    {
        $this->_authDto = $authDto;
    }

    public function getAuthDto()
    {
        return $this->_authDto;
    }

}
