<?php

namespace App\Exceptions;

use Exception;

class GeminiApiException extends Exception
{
    protected $details;

    public function __construct($message = "", $code = 0, Exception $previous = null, $details = null)
    {
        parent::__construct($message, $code, $previous);
        $this->details = $details;
    }

    public function getDetails()
    {
        return $this->details;
    }
}
