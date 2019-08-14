<?php

class PagueVeloz_Api_Model_Webservice_ContaBancaria extends PagueVeloz_Api_Model_Webservice_PagueVeloz
{

    private $_default_header = 'Content-Type: application/json';
    private $_authDto;

    public function __construct(PagueVeloz_Api_Model_Dto_EmailDTO $email, $token)
    {
        $machine = null;
        $this->setAuthDto(new PagueVeloz_Api_Model_Dto_AuthenticationDTO($email->getEmail(), $token));

        parent::__construct('api/v2/ContaBancaria', $this->getAuthDto(), $machine);
    }

    public function Get()
    {
        $contexto = Mage::getModel('pagueveloz_api/common_httpContext');
        $contexto->setMethod('get');
        $contexto->addHeader($this->_default_header);
        $contexto->setAuthorization($this->getAuthDto()->getEmail(), $this->getAuthDto()->getToken());
        $contexto->setHost($this->getHost());

        return $this->getMachine()->Send($contexto);
    }

    public function GetById(PagueVeloz_Api_Model_Dto_ContaBancariaDTO $dto)
    {
        $contexto = Mage::getModel('pagueveloz_api/common_httpContext');
        $contexto->setMethod('get');
        $contexto->addHeader($this->_default_header);
        $contexto->setAuthorization($this->getAuthDto()->getEmail(), $this->getAuthDto()->getToken());
        $contexto->setHost($this->getHost() . '?id=' . $dto->getId());

        return $this->getMachine()->Send($contexto);
    }

    public function Post(PagueVeloz_Api_Model_Dto_ContaBancariaDTO $dto)
    {
        $contexto = Mage::getModel('pagueveloz_api/common_httpContext');
        $contexto->setMethod('post');
        $contexto->addHeader($this->_default_header);
        $contexto->setAuthorization($this->getAuthDto()->getEmail(), $this->getAuthDto()->getToken());
        $contexto->setHost($this->getHost());

        $json = '{
				   "CodigoBanco": %u,
		 	       "CodigoAgencia": %u,
		 	       "NumeroConta": %u,
		 	       "Descricao": "%s"
		 	     }';
        $json = sprintf($json, $dto->getBanco(), $dto->getAgencia(), $dto->getConta(), $dto->getDescricao());

        $contexto->setBody($json);

        return $this->getMachine()->Send($contexto);
    }

    public function Put(PagueVeloz_Api_Model_Dto_ContaBancariaDTO $dto)
    {
        $contexto = Mage::getModel('pagueveloz_api/common_httpContext');
        $contexto->setMethod('put');
        $contexto->addHeader($this->_default_header);
        $contexto->setAuthorization($this->getAuthDto()->getEmail(), $this->getAuthDto()->getToken());
        $contexto->setHost($this->getHost() . '?id=' . $dto->getId());

        $json = '{
			       "CodigoBanco"   : %u,
		 	       "CodigoAgencia" : %u,
		 	       "NumeroConta"   : %u,
		 	       "Descricao"     : "%s",
		 	   	   "Id"            : %u
		 	   	 }';
        $json = sprintf($json, $dto->getBanco(), $dto->getAgencia(), $dto->getConta(), $dto->getDescricao(), $dto->getId());

        $contexto->setBody($json);

        return $this->getMachine()->Send($contexto);
    }

    public function Delete(PagueVeloz_Api_Model_Dto_ContaBancariaDTO $dto)
    {
        $contexto = Mage::getModel('pageuveloz/common_httpContext');
        $contexto->setMethod('delete');
        $contexto->addHeader($this->_default_header);
        $contexto->setAuthorization($this->getAuthDto()->getEmail(), $this->getAuthDto()->getToken());
        $contexto->setHost($this->getHost() . '?id=' . $dto->getId());

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
