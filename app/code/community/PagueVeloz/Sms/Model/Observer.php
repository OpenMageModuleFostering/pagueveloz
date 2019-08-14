<?php

class PagueVeloz_Sms_Model_Observer
{
    /*
      verify to send sms by pagueveloz api
     */

    public function after_save_order($object)
    {
        $order = $object->getEvent()->getOrder();

        try {
            $template = Mage::getModel('pagueveloz_sms/template')->loadEnabledByStatusCode($order->getStatus());
            if ($template) {
                $sms = Mage::getModel('pagueveloz_sms/sms');
                $sms->setOrderId($order->getId())
                        ->setStatus(PagueVeloz_Sms_Model_Sms::SMS_NEW)
                        ->setTemplateId($template->getId())
                        ->save();
            }
        } catch (Exception $ex) {
            Mage::getModel('pagueveloz_sms/sms')->log($ex->getMessage());
        }

        return $this;
    }

}
