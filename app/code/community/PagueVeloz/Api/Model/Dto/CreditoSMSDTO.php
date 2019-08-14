<?php

class PagueVeloz_Api_Model_Dto_CreditoSMSDTO
{

    protected $_data;

    public function setData($data)
    {
        if (empty($data)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("Argumento informado não deve ser NULL. \"$data\" é null.");
        }

        $this->_data = $data;
    }

    public function getData()
    {
        return $this->_data;
    }

}
