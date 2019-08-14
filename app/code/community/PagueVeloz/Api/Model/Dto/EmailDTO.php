<?php

class PagueVeloz_Api_Model_Dto_EmailDTO
{

    private $_email;

    public function __construct($email)
    {
        $this->setEmail($email);
    }

    public function setEmail($email)
    {
        if (empty($email))
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("$email é null");
        else if (!self::isValidEmail($email))
            throw new PagueVeloz_Api_Model_Exceptions_InvalidEmailException("$email é inválido");

        $this->_email = $email;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    private static function isValidEmail($email)
    {
        return 1 === preg_match('/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21\\x23-\\x5b\\x5d-\\x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21-\\x5a\\x53-\\x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])+)\\])/', $email);
    }

}
