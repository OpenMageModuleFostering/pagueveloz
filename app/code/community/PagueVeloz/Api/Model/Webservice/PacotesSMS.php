<?php

class PagueVeloz_Api_Model_Webservice_PacotesSMS extends PagueVeloz_Api_Model_Webservice_PagueVeloz
{

    private $_default_header = 'Content-Type: application/json';
    private $_authDto;

    public function __construct(PagueVeloz_Api_Model_Dto_EmailDTO $email, $token)
    {
        $machine = null;
        $this->setAuthDto(new PagueVeloz_Api_Model_Dto_AuthenticationDTO($email->getEmail(), $token));

        parent::__construct('api/v1/PacotesSMS', $this->getAuthDto(), $machine);
    }

    public function Get(PagueVeloz_Api_Model_Dto_PacotesSMSDTO $dto)
    {
        $contexto = Mage::getModel('pagueveloz_api/common_httpContext');
        $contexto->setMethod('get');
        $contexto->addHeader($this->_default_header);
        $contexto->setAuthorization($this->getAuthDto()->getEmail(), $this->getAuthDto()->getToken());
        $contexto->setHost($this->getHost());

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

