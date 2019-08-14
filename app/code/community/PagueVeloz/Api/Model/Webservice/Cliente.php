<?php

class PagueVeloz_Api_Model_Webservice_Cliente extends PagueVeloz_Api_Model_Webservice_PagueVeloz
{

    private $_default_header = 'Content-Type: application/json';
    private $_authDto;

    public function __construct(PagueVeloz_Api_Model_Dto_EmailDTO $email, $token)
    {
        $machine = null;
        $this->setAuthDto(new PagueVeloz_Api_Model_Dto_AuthenticationDTO($email->getEmail(), $token));

        parent::__construct('api/v1/Cliente', $this->getAuthDto(), $machine);
    }

    public function Put(PagueVeloz_Api_Model_Dto_ClienteDTO $dto)
    {
        $contexto = Mage::getModel('pagueveloz_api/common_httpContext');
        $contexto->setMethod('put');
        $contexto->addHeader($this->_default_header);
        $contexto->setAuthorization($this->getAuthDto()->getEmail(), $this->getAuthDto()->getToken());
        $contexto->setHost($this->getHost());

        $json = array(
            'Id' => 4,
            'Nome' => $dto->getNome(),
            'Email' => $dto->getEmail(),
            'EnviarEmailBoletosPagos' => $dto->getEnviarEmailBoletosPagos(),
            'Endereco' => array(
                'Logradouro' => $dto->getRua(),
                'Numero' => $dto->getNumero(),
                'CEP' => $dto->getCep(),
                'Cidade' => array(
                    'Nome' => $dto->getCidade(),
                    'Estado' => $dto->getEstado(),
                )
            )
        );

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
