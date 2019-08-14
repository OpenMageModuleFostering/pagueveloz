<?php

class PagueVeloz_Sms_Model_Template extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('pagueveloz_sms/template'); // this is location of the resource file.
    }

    public function loadByStatusCode($statusCode)
    {
        $collection = $this->getCollection();
        $collection->addFieldToSelect('*')
                ->addFieldToFilter('status_code', array('eq' => $statusCode))
                ->getSelect()
                ->limit(1);
        $collection->load();

        return $collection->getLastItem();
    }

    public function loadEnabledByStatusCode($statusCode)
    {
        $collection = $this->getCollection();
        $collection->addFieldToSelect('*')
                ->addFieldToFilter('status_code', array('eq' => $statusCode))
                ->addFieldToFilter('enabled', array('eq' => 1))
                ->getSelect()
                ->limit(1);
        $collection->load();

        return $collection->getLastItem();
    }

    public function getId()
    {
        return $this->getSmsTemplateId();
    }

    public function getMessage()
    {
        return $this->getTemplate();
    }

}
