<?php

class PagueVeloz_Boleto_Block_Adminhtml_Sales_Order_View_Tab_Boleto extends Mage_Adminhtml_Block_Sales_Order_Abstract implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('pagueveloz/boleto.phtml');
    }

    /**
     * Retrieve order model instance
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        return Mage::registry('current_order');
    }

    /**
     * Retrieve source model instance
     *
     * @return Mage_Sales_Model_Order
     */
    public function getSource()
    {
        return $this->getOrder();
    }

    public function getBoleto()
    {
        return Mage::getModel('pagueveloz_boleto/boleto')->loadByOrderId($this->getOrder()->getId());
    }

    /**
     * ######################## TAB settings #################################
     */
    public function getTabLabel()
    {
        return Mage::helper('sales')->__('Pague Veloz - Boleto');
    }

    public function getTabTitle()
    {
        return Mage::helper('sales')->__('Pague Veloz - Boleto');
    }

    public function canShowTab()
    {
        return ($this->getOrder()->getPayment()->getMethodInstance()->getCode() == 'pagueveloz_boleto') ? true : false;
    }

    public function isHidden()
    {
        return ($this->getOrder()->getPayment()->getMethodInstance()->getCode() == 'pagueveloz_boleto') ? false : true;
    }

}
