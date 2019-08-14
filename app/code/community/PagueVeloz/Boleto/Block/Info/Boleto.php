<?php

/**
 * @category    Boleto
 * @package     PagueVeloz_Boleto
 * @copyright   André Felipe (andrew.daluz@gmail.com)
 */
class PagueVeloz_Boleto_Block_Info_Boleto extends Mage_Payment_Block_Info
{

    protected $_instructions;

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('payment/info/pagueveloz_boleto.phtml');
    }

    /**
     * Get instructions text from order payment
     * (or from config, if instructions are missed in payment)
     *
     * @return string
     */
    public function getInstructions()
    {
        if (is_null($this->_instructions)) {
            $this->_instructions = $this->getInfo()->getAdditionalInformation('instructions');
            if (empty($this->_instructions)) {
                $this->_instructions = $this->getMethod()->getInstructions();
            }
        }
        return $this->_instructions;
    }

}
