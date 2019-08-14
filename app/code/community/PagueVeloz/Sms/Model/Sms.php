<?php

class PagueVeloz_Sms_Model_Sms extends Mage_Core_Model_Abstract
{

    const SMS_SENDED = 'enviado';
    const SMS_RESEND = 'reenviar';
    const SMS_NEW = 'novo';
    const SMS_ERROR = 'erro';

    public function _construct()
    {
        parent::_construct();
        $this->_init('pagueveloz_sms/sms'); // this is location of the resource file.
    }

    public function getId()
    {
        return $this->getSmsId();
    }

    public function getTemplate()
    {
        return Mage::getModel('pagueveloz_sms/template')->load($this->getTemplateId());
    }

    public function getOrder()
    {
        return Mage::getModel('sales/order')->load($this->getOrderId());
    }

    public function log($msg)
    {
        return Mage::log($msg, null, 'pagueveloz_sms.log');
    }

}
