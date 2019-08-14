<?php

class PagueVeloz_Boleto_Model_Cron
{

    public static function verificaBoletoPago()
    {
        $boletosPago = array();
        $boletoMethod = Mage::getModel('pagueveloz_boleto/boletoMethod');
        $_diasVencimento = $boletoMethod->getConfig('vencimento');

        /*
         * @TODO Usar enum/constante para status de "pago"
         * @TODO Não considerar boletos já vencidos
         */

        $_boletos = Mage::getModel('pagueveloz_boleto/boleto')->getCollection()
                ->addFieldToFilter('status', array('neq' => 'pago'));
        try {
            foreach ($_boletos as $_boleto) {
                $pagamento = $_boleto->getPagamento();
            }
        } catch (Exception $e) {
            $boletoMethod->log($e->getMessage());
        }

    }
}
