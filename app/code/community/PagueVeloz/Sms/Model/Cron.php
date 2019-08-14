<?php

class PagueVeloz_Sms_Model_Cron
{

    public function sendSMS()
    {
        try {
            $_smsCollection = Mage::getModel('pagueveloz_sms/sms')->getCollection();
            $_smsCollection->addFieldToFilter('status', array(
                        'in' => array(PagueVeloz_Sms_Model_Sms::SMS_NEW, PagueVeloz_Sms_Model_Sms::SMS_RESEND)
                            )
                    )
                    ->setOrder('created_time') // Os ultimos criados primeiro
                    ->setPageSize(100); // Processa 100 por vez

            $webservicePagueveloz = Mage::getModel('pagueveloz_api/webservice');

            foreach ($_smsCollection as $sms) {
                $order = $sms->getOrder();
                if ($order->getIncrementId()) {
                    $billing_address = $order->getBillingAddress();
                    $telephone = $billing_address->getTelephone();
                    $msg = $sms->getTemplate()->getMessage();
                    $result = $webservicePagueveloz->sendSMS($msg, $telephone);
                    $this->writeFile("Result : " . $result);
                    $sms->log($order->getIncrementId() . ": " . $result);
                }
            }
        } catch (Exception $e) {
            //$this->writeFile($e->getMessage());
            $sms->log($e->getMessage());
        }
    }

    public function writeFile($msg)
    {
        $file = '/home/andre/workspace/magento/var/log/SMS_TESTES.txt';
        // Open the file to get existing content
        $current = file_get_contents($file);
        // Append a new person to the file
        $current .= $msg . "\n";
        // Write the contents back to the file
        file_put_contents($file, $current);
    }

}
