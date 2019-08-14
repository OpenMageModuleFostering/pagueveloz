<?php

class PagueVeloz_Api_Model_Webservice_ComprarCreditosSMS extends PagueVeloz_Api_Model_Webservice_PagueVeloz
{

    const COMPRA_POR_CREDITO = 0;
    const COMPRA_POR_VALOR = 1;
    const PAGAMENTO_POR_BOLETO = 0;
    const PAGAMENTO_POR_DEPOSITO = 1;

    private $_default_header = 'Content-Type: application/json';
    private $_authDto;

    public function __construct(PagueVeloz_Api_Model_Dto_EmailDTO $email, $token)
    {
        $machine = null;
        $this->setAuthDto(new PagueVeloz_Api_Model_Dto_AuthenticationDTO($email->getEmail(), $token));
        $host = 'api/v2/ComprarCreditoSMS';

        parent::__construct($host, $this->getAuthDto(), $machine);
    }

    public function Post(PagueVeloz_Api_Model_Dto_ComprarCreditosSMSDTO $dto)
    {
        $contexto = Mage::getModel('pagueveloz_api/common_httpContext');
        $contexto->setMethod('post');
        $contexto->addHeader($this->_default_header);
        $contexto->setAuthorization($this->getAuthDto()->getEmail(), $this->getAuthDto()->getToken());
        $contexto->setHost($this->getHost());

        $json = array(
            'FormaPagto' => $dto->getFormatPto()
        );

        if ($dto->getCreditos()) {
            $json['Creditos'] = $dto->getCreditos();
        } else {
            $json['Valor'] = $dto->getValor();
        }

        $json = json_encode($json);
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
