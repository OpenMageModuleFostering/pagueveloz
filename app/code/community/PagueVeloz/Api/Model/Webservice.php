<?php

/*
 *  Cria metodos que mapeia as funcionalidades da API PagueVeloz
 */

class PagueVeloz_Api_Model_Webservice extends Mage_Core_Model_Abstract
{

    const PAGUEVELOZ_URL_STAGING = 'http://sandbox.pagueveloz.com.br/';
    const PAGUEVELOZ_URL_PRODUCTION = 'https://www.pagueveloz.com.br/';

    public function getPaguevelozEmail()
    {
        return Mage::getStoreConfig('pagueveloz/pagueveloz_configuration/email');
    }

    public function getPaguevelozToken()
    {
        return Mage::getStoreConfig('pagueveloz/pagueveloz_configuration/token');
    }

    public function getIsProduction()
    {
        return Mage::getStoreConfig('pagueveloz/pagueveloz_configuration/production');
    }

    public function getPaguevelozUrl()
    {
        if ($this->getIsProduction()) {
            return self::PAGUEVELOZ_URL_PRODUCTION;
        }

        return self::PAGUEVELOZ_URL_STAGING;
    }

    public function getCreditoSMS()
    {
        $creditoSMS = new PagueVeloz_Api_Model_Webservice_CreditoSMS(Mage::getModel('pagueveloz_api/dto_emailDTO', $this->getPaguevelozEmail()), $this->getPaguevelozToken());
        $dto = Mage::getModel('pagueveloz_api/dto_creditoSMSDTO');

        $resposta_final = $creditoSMS->Get($dto);

        $saldo = $resposta_final->getBody();
        if (stripos($saldo, 'Erro') !== false) {
            $saldo = "";
        }

        return $saldo;
    }

    public function comprarCreditosSMS($tipo_pagamento, $tipo_credito, $valor)
    {
        $comprarCreditosSMS = new PagueVeloz_Api_Model_Webservice_ComprarCreditosSMS(Mage::getModel('pagueveloz_api/dto_emailDTO', $this->getPaguevelozEmail()), $this->getPaguevelozToken());
        $dto = Mage::getModel('pagueveloz_api/dto_ComprarCreditosSMSDTO');
        $dto->setFormaPgto($tipo_pagamento);

        if ($tipo_credito == PagueVeloz_Api_Model_Webservice_ComprarCreditosSMS::COMPRA_POR_VALOR) {
            $dto->setValor($valor);
        } else {
            $dto->setCreditos($valor);
        }

        $resposta_final = $comprarCreditosSMS->Post($dto);

        $result = $resposta_final->getBody();
        if (stripos($result, 'Erro') !== false) {
            $result = "";
        }

        return json_decode($result);
    }

    public function getPacotesSMS()
    {
        $pacotesSMS = new PagueVeloz_Api_Model_Webservice_PacotesSMS(Mage::getModel('pagueveloz_api/dto_emailDTO', $this->getPaguevelozEmail()), $this->getPaguevelozToken());
        $dto = Mage::getModel('pagueveloz_api/dto_PacotesSMSDTO');

        $resposta_final = $pacotesSMS->Get($dto);

        $pacotes = $resposta_final->getBody();
        if (stripos($pacotes, 'Erro') !== false) {
            $pacotes = "";
        }

        return json_decode($pacotes);
    }

    public function sendSms($msg, $telefoneDestino)
    {
        $telefoneRemetente = Mage::getStoreConfig('pagueveloz/sms/telephone');
        $msgSMS = new PagueVeloz_Api_Model_Webservice_MensagemSMS(Mage::getModel('pagueveloz_api/dto_emailDTO', $this->getPaguevelozEmail()), $this->getPaguevelozToken());
        $dto = Mage::getModel('pagueveloz_api/dto_MensagemSMSDTO');
        $dto->setTelefoneDestino($telefoneDestino);
        $dto->setConteudo($msg);
        $dto->setTelefoneRemetente($telefoneRemetente);

        $resposta_final = $msgSMS->Post($dto);

        $result = $resposta_final->getBody();
        if (stripos($result, 'Erro') !== false) {
            $result = "";
        }

        return json_decode($result);
    }

    public function atualizaCliente($clienteDto)
    {
        $cliente = new PagueVeloz_Api_Model_Webservice_Cliente(Mage::getModel('pagueveloz_api/dto_emailDTO', $this->getPaguevelozEmail()), $this->getPaguevelozToken());
        $resposta_final = $cliente->Put($clienteDto);

        $result = $resposta_final->getBody();
        if (stripos($result, 'Erro') !== false) {
            $result = "";
        }

        return json_decode($result);
    }

    public function cadastrarConta($codigo_barras, $nome_titulo, $titulo, $valor, $vencimento)
    {
        $contaWebservice = new PagueVeloz_Api_Model_Webservice_Conta(Mage::getModel('pagueveloz_api/dto_emailDTO', $this->getPaguevelozEmail()), $this->getPaguevelozToken());
        $dto = Mage::getModel('pagueveloz_api/dto_contaDTO');
        $dto->setCodigoDeBarras($codigo_barras);
        $dto->setValor($valor);
        $dto->setTitulo($titulo);
        $dto->setNomeTitulo($nome_titulo);
        $dto->setVencimento($vencimento);

        $resposta_final = $contaWebservice->Post($dto);

        $result = $resposta_final->getBody();
        if (stripos($result, 'Erro') !== false) {
            $result = "";
        }

        return json_decode($result);
    }

    public function generateBoletoUrl($valor, $seuNumero, $nome, $cpf, $email)
    {
        $boleto = new PagueVeloz_Api_Model_Webservice_Boleto(Mage::getModel('pagueveloz_api/dto_emailDTO', $this->getPaguevelozEmail()), $this->getPaguevelozToken());
        $dto = Mage::getModel('pagueveloz_api/dto_boletoDTO');
        $boletoMethod = Mage::getModel('pagueveloz_boleto/boletoMethod');

        $vencimento = (int) $boletoMethod->getConfig('vencimento');
        $date = date("Y-m-d"); // Data de hoje
        $mod_date = strtotime($date . "+ {$vencimento} days"); // Soma dias na data
        $dataVencimento = date("Y-m-d", $mod_date);

        $dto->setEmail($email);
        $dto->setVencimento($dataVencimento);
        $dto->setValor($valor);
        $dto->setSeuNumero($seuNumero);
        $dto->setSacado($nome);
        $dto->setCpfCnpjSacado($cpf);
        $dto->setParcela(1);
        $dto->setLinha1($boletoMethod->getConfig('instruction1'));
        $dto->setLinha2($boletoMethod->getConfig('instruction2'));
        $dto->setCpfCnpjCedente($boletoMethod->getConfig('taxvat'));
        $dto->setCedente($boletoMethod->getConfig('cedente_name'));
        $resposta_final = $boleto->Post($dto);
        $url = $resposta_final->getBody();

        if (stripos($url, 'Erro') !== false) {
            $url = "";
        }

        return $url;
    }

    public function assinar($nome, $doc, $tipoPessoa, $email, $login, $estado, $cidade, $rua, $cep, $numero)
    {
        $assinar = new PagueVeloz_Api_Model_Webservice_Assinar();
        $dto = new PagueVeloz_Api_Model_Dto_AssinarDTO(); //Mage::getModel('pagueveloz_api/dto_assinarDTO');

        $dto->setEmail($email);
        $dto->setNome($nome);
        $dto->setDocumento($doc);
        $dto->setTipoPessoa($tipoPessoa);
        $dto->setLoginUsuarioDefault($login);
        $dto->setEstado($estado);
        $dto->setCidade($cidade);
        $dto->setRua($rua);
        $dto->setCep($cep);
        $dto->setNumero($numero);

        $resposta_final = $assinar->Post($dto);
        $result = $resposta_final->getBody();
        if (stripos($result, 'Erro') !== false) {
            $url = "";
        }

        return json_decode($result);
    }

}
