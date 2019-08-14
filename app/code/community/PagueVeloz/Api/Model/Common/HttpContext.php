<?php

class PagueVeloz_Api_Model_Common_HttpContext
{

    private $_headers = array();
    private $_method = 'GET';
    private $_body = '';
    private $_host = '';

    public function setAuthorization($email, $token)
    {
        if (empty($token)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("$token é nulo");
        }

        $this->addHeader('Authorization: Basic ' . base64_encode($email . ":" . $token));
    }

    public function addHeader($header)
    {
        if (empty($header)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("$header é nulo");
        }

        if (!in_array($header, $this->getHeaders()))
            $this->_headers[] = $header;
    }

    public function setMethod($method)
    {
        if (empty($method)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("$method é nulo");
        }

        $method = strtolower($method);

        if (!in_array($method, array('get', 'post', 'put', 'delete'))) {
            throw new PagueVeloz_Api_Model_Exceptions_InvalidMethodException("$method é inválido");
        }

        $this->_method = $method;
    }

    public function setBody($body)
    {
        if (empty($body)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("$body é nulo, este argumento deve ser informado");
        }

        // TODO
        // se header contem content/type json? então faz json_decode($body)

        if (json_decode($body) === null) {
            throw new PagueVeloz_Api_Model_Exceptions_InvalidJSONException("$body é inválido");
        }

        $this->_body = $body;
    }

    public function setHost($host)
    {
        if (empty($host)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("$host é nulo, este argumento deve ser informado");
        }

        $this->_host = $host;
    }

    public function getHeaders()
    {
        return $this->_headers;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function getBody()
    {
        return $this->_body;
    }

    public function getHost()
    {
        return $this->_host;
    }

}
