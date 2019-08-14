<?php

class PagueVeloz_Api_Model_Exceptions_InvalidJSONException extends Exception
{

    public function __construct($message, $code, $previous)
    {
        parent::__construct($message, $code, $previous);
    }

}
