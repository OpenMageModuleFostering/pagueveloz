<?php

class PagueVeloz_Boleto_Block_Adminhtml_Content extends Mage_Adminhtml_Block_Template
{

    protected $_webservice;

    public function getWebService()
    {
        if (!$this->_webservice) {
            $this->_webservice = Mage::getModel("pagueveloz_api/webservice");
        }

        return $this->_webservice;
    }

}
