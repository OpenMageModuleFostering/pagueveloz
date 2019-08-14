<?php

class PagueVeloz_Sms_Model_Mysql4_Sms extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('pagueveloz_sms/sms', 'sms_id');  // here test_id is the primary of the table test. And test/test, is the magento table name as mentioned in the       //config.xml file.
    }

}
