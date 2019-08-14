<?php

class PagueVeloz_Api_Model_Dto_AuthenticationDTO
{

    private $_email;
    private $_token;

    public function __construct($email, $token)
    {
        $this->setEmail($email);
        $this->setToken($token);
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function setToken($token)
    {
        if (empty($token)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("$token é null. Argumento \"Token\" não pode ser NULL ou vazio.");
        }

        $this->_token = $token;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getToken()
    {
        return $this->_token;
    }

}
