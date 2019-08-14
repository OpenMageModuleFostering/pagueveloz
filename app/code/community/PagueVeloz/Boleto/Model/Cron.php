<?php

class PagueVeloz_Boleto_Model_Cron
{

    public static function verificaBoletoPago()
    {
        $boletosPago = array();
        $boletoMethod = Mage::getModel('pagueveloz_boleto/boletoMethod');

        /*
         * @TODO Usar enum/constante para status de "pago"
         */

        $_boletos = Mage::getModel('pagueveloz_boleto/boleto')->getCollection()
            ->addFieldToFilter('status', array('nin' => array('pago','vencido')));

        try {
            if ($_boletos) {
                foreach ($_boletos as $_boleto) {               
                    $pagamento  = $_boleto->getPagamento();
                    $_boleto->isVencimento($pagamento);
                }
            }
        } catch (Exception $e) {
            $boletoMethod->log($e->getMessage());
        }
    }
}
