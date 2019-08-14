<?php

class PagueVeloz_Api_Model_Webservice_EmitirBoleto extends PagueVeloz_Api_Model_Webservice_PagueVeloz
{

    private $_default_header = 'content-type: application/json';
    private $_authDto;

    public function __construct(PagueVeloz_Api_Model_Dto_EmailDTO $email, $token, PagueVeloz_Api_Model_Interfaces_IHttpClient $machine = null)
    {
        $this->setAuthDto(new PagueVeloz_Api_Model_Dto_AuthenticationDTO($email->getEmail(), $token));

        parent::__construct('api/v1/EmitirBoleto', $this->getAuthDto(), $machine);
    }

    public function Post(PagueVeloz_Api_Model_Dto_EmitirBoletoDTO $dto)
    {
        $contexto = Mage::getModel('pagueveloz_api/common_httpContext');
        $contexto->setMethod('post');
        $contexto->addHeader($this->_default_header);
        $contexto->setAuthorization($this->getAuthDto()->getEmail(), $this->getAuthDto()->getToken());
        $contexto->setHost($this->getHost());

        $json = '{
					"Vencimento": "%s"
					, "Valor"          : %u
					, "SeuNumero"      : "%s"
					, "Sacado"         : "%s"
					, "CPFCNPJSacado"  : "%s"
					, "Parcela"        : "%s"
					, "Linha1"         : "%s"
					, "Linha2"         : "%s"
					, "CPFCNPJCedente" : "%s"
					, "Cedente"        : "%s"
				}';

        $json = sprintf($json, $dto->getVencimento(), $dto->getValor(), $dto->getSeuNumero(), $dto->getSacado(), $dto->getCpfCnpjSacado(), $dto->getParcela(), $dto->getLinha1(), $dto->getLinha2(), $dto->getCpfCnpjCedente(), $dto->getCedente()
        );

        $contexto->setBody($json);

        return $this->getMachine()->Send($contexto);
    }

    private function setAuthDto(PagueVeloz_Api_Model_Dto_AuthenticationDTO $authDto)
    {
        $this->_authDto = $authDto;
    }

    private function getAuthDto()
    {
        return $this->_authDto;
    }

}
