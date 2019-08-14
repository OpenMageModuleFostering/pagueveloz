<?php

class PagueVeloz_Sms_Block_Adminhtml_Content extends Mage_Adminhtml_Block_Template
{

    protected $_webservice;

    public function getWebService()
    {
        if (!$this->_webservice) {
            $this->_webservice = Mage::getModel("pagueveloz_api/webservice");
        }

        return $this->_webservice;
    }

    public function getSaldo()
    {
        return $this->getWebservice()->getCreditoSMS();
    }

    public function getPacotesSms()
    {
        return $this->getWebservice()->getPacotesSMS();
    }

    public function getTemplatesSMS()
    {
        return Mage::getModel('pagueveloz_sms/template')->getCollection();
    }

    public function getStatuses()
    {
        return Mage::getModel('sales/order_status')->getResourceCollection();
    }

    public function getTemplateByStatus($status)
    {
        if ($templateSms = Mage::getModel('pagueveloz_sms/template')->loadByStatusCode($status)) {
            return $templateSms;
        }

        return new Varien_Object();
    }

}
