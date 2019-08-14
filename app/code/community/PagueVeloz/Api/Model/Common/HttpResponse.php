<?php

class PagueVeloz_Api_Model_Common_HttpResponse
{

    private $_status = 200;
    private $_headers = array();
    private $_body;

    public function setStatus($status)
    {
        if (empty($status)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("$status é null. O parametro \"Status\" não deve ser NULL ou vazio.");
        }

        $this->_status = $status;
    }

    public function addHeaders($headers)
    {
        if (empty($headers)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("$headers é null. O \"Header\" não pode ser NULL ou vazio.");
        }

        $this->_headers[] = $headers;
    }

    public function setBody($body)
    {
        $this->_body = $body;
    }

    public function getStatus()
    {
        return $this->_status;
    }

    public function getHeaders()
    {
        return $this->_headers;
    }

    public function getBody()
    {
        return $this->_body;
    }

}
