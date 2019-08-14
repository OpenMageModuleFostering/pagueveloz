<?php

class PagueVeloz_Sms_Model_Mysql4_Sms_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('pagueveloz_sms/sms');
    }

}
