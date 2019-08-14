<?php

class PagueVeloz_Api_Model_Services_Curl implements PagueVeloz_Api_Model_Interfaces_IHttpClient
{

    private $_curl;

    public function __construct()
    {
        $this->_curl = curl_init();

        if (empty($this->_curl)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("curl_init is null");
        }
    }

    public function Send(PagueVeloz_Api_Model_Common_HttpContext $context)
    {
        if (empty($context)) {
            throw new PagueVeloz_Api_Model_Exceptions_ArgumentNullException("$context is null");
        }

        curl_setopt($this->_curl, CURLOPT_URL, $context->getHost());
        curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, $context->getMethod());
        curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $context->getBody());
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->_curl, CURLOPT_HEADER, 1);

        if (substr($context->getHost(), 0, 5) == 'https') {
            curl_setopt($this->_curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($this->_curl, CURLOPT_SSL_VERIFYPEER, 0);
        }

        if (in_array($context->getMethod(), array('post', 'put'))) {
            $context->addHeader('Content-Length: ' . strlen($context->getBody()));
        }

        curl_setopt($this->_curl, CURLOPT_HTTPHEADER, $context->getHeaders());

        $raw_result = curl_exec($this->_curl);
        $pos = strpos($raw_result, "\r\n\r\n");

        $headers = explode("\r\n", substr($raw_result, 0, $pos));

        $response = new PagueVeloz_Api_Model_Common_HttpResponse();
        $response->addHeaders($headers);

        // +4 porque é duplo \r\n que são as 2 linhas no fim do header
        $response->setBody(substr($raw_result, $pos + 4));

        $return_info = curl_getinfo($this->_curl);
        $response->setStatus($return_info['http_code']);

        return $response;
    }

    public function __destruct()
    {
        curl_close($this->_curl);
    }

}
