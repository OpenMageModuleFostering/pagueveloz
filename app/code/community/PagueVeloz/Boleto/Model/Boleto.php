<?php

class PagueVeloz_Boleto_Model_Boleto extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('pagueveloz_boleto/boleto'); // this is location of the resource file.
    }

    public function saveWithConfigData()
    {
        $vencimento = (int) Mage::getModel('pagueveloz_boleto/boletoMethod')->getConfig('vencimento');
        $date = date("Y-m-d"); // Data de hoje
        $mod_date = strtotime($date . "+ {$vencimento} days"); // Soma dias na data
        $dataVencimento = date("Y-m-d", $mod_date);

        $this->setDataVencimento($dataVencimento);
        $this->setStatus(0);

        return $this->save();
    }

    public function loadByOrderId($orderId)
    {
        $item = $this->getCollection()->addFieldToFilter('order_id', array('in' => $orderId))->getFirstItem();
        if ($item) {
            return $item;
        }

        return $this;
    }

    public function getId()
    {
        return $this->getBoletoId();
    }

    public function getPagamento()
    {
        $boletoMethod = Mage::getModel('pagueveloz_boleto/boletoMethod');
        $_diasVencimento = $boletoMethod->getConfig('vencimento');

        $_order = Mage::getModel('sales/order')->load($this->getOrderId());
        try {
            $_boletosData = $boletoMethod->getBoletoPago($this->getSeuNumero());
            if ($_boletosData) {
                foreach ($_boletosData as $_boleto) {

                    if (($_boleto->SeuNumero == $this->getSeuNumero()) && $_boleto->TemPagamento) {
                        $_order->setStatus($boletoMethod->getOrderStatus())
                            ->setState($boletoMethod->getOrderStatus())
                            ->addStatusHistoryComment("BOLETO PAGO EM: {$_boleto->DataPagamento} | R$ {$_boleto->ValorPago}")
                            ->save();

                        $this->setStatus('pago')
                            ->setValorPago($_boleto->ValorPago)
                            ->setUpdatedTime(Mage::getSingleton('core/date')->gmtDate())
                            ->save();

                        $_boleto->Status = 'pago';

                        $boletoMethod->log("[{$this->getSeuNumero()}] Boleto Pago | ID: " . $_boleto->Id . " | URL: " . $_boleto->Url);
                        return $_boleto;
                    }
                }
            }
        } catch (Exception $e) {
            $boletoMethod->log($e->getMessage());
        }
    }

    public function generate($order)
    {
        $customer = Mage::getModel("customer/customer")->load($order->getCustomerId());
        $valor = $order->getGrandTotal();
        $seuNumero = $order->getIncrementId();
        $nome = $order->getCustomerName();
        $cpf = $customer->getTaxvat();
        $email = $order->getCustomerEmail();
        $boleto = $this->loadByOrderId($order->getId());
        if (!$boleto->getId()) {
            $webservice = Mage::getModel('pagueveloz_api/webservice');
            $url = $webservice->generateBoletoUrl($valor, $seuNumero, $nome, $cpf, $email);
            if ($url) {
                $this->setUrl($url);
                $this->setValor($valor);
                $this->setOrderId($order->getId());
                $this->setSeuNumero($seuNumero);
                $this->saveWithConfigData();
            }

            $boleto = $this;
        }

        return $boleto;
    }

    public function regenerate()
    {
        $this->setQtyRegerado($this->getQtyRegerado()+1);
        $order = $this->getOrder();
        $customer = Mage::getModel("customer/customer")->load($order->getCustomerId());
        $webservice = Mage::getModel('pagueveloz_api/webservice');
        $seuNumero = $order->getIncrementId() . "-" . $this->getQtyRegerado();
        $this->setSeuNumero($seuNumero);
        $nome = $order->getCustomerName();
        $cpf = $customer->getTaxvat();
        $email = $order->getCustomerEmail();

        $url = $webservice->generateBoletoUrl($this->getValor(), $seuNumero, $nome, $cpf, $email);
        if ($url) {
            $this->url = $url;
            $this->save();
        }

        return $url;
    }

    public function getOrder()
    {
        return Mage::getModel('sales/order')->load($this->getOrderId());
    }

}
