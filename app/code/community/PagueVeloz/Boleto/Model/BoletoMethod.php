<?php

class PagueVeloz_Boleto_Model_BoletoMethod extends Mage_Payment_Model_Method_Banktransfer
{

    const PAYMENT_METHOD_BANKTRANSFER_CODE = 'pagueveloz_boleto';

    protected $webserivce = null;
    protected $_code = self::PAYMENT_METHOD_BANKTRANSFER_CODE;
    protected $_formBlockType = 'pagueveloz_boleto/form_boleto';
    protected $_infoBlockType = 'pagueveloz_boleto/info_boleto';

    public function getInstructions()
    {
        if (!$this->getConfig('instruction1') && !$this->getConfig('instruction2')) {
            return '';
        }
        
        return $this->getConfig('instruction1') . "<br>" . $this->getConfig('instruction2');
    }

    public function getPaidOrderStatus()
    {
        return Mage::getStoreConfig('payment/pagueveloz_boleto/order_status_paid');
    }

    public function getNewOrderStatus()
    {
        return Mage::getStoreConfig('payment/pagueveloz_boleto/order_status_new');
    }

    public function log($msg)
    {
        Mage::log($msg, null, $this->_code . '.log');
    }

    public function getConfig($key)
    {
        return Mage::getStoreConfig("payment/{$this->_code}/{$key}");
    }

    public function getEmail()
    {
        return $this->getWebservice()->getPaguevelozEmail();
    }

    public function getToken()
    {
        return $this->getWebservice()->getPaguevelozToken();
    }

    public function getWebservice()
    {
        if (!$this->webservice) {
            $this->webservice = Mage::getModel('pagueveloz_api/webservice');
        }

        return $this->webservice;
    }

    public function getBoletoPago($seuNumero)
    {
        $boleto = new PagueVeloz_Api_Model_Webservice_Boleto(Mage::getModel('pagueveloz_api/dto_emailDTO', $this->getEmail()), $this->getToken());

        $dto = Mage::getModel('pagueveloz_api/dto_boletoDTO');
        $dto->setSeuNumero($seuNumero);
        $resposta_final = $boleto->Get($dto);

        return json_decode($resposta_final->getBody());
    }

}
