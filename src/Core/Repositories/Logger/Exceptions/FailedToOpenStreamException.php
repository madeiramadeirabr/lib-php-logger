<?php

namespace MadeiraMadeira\Logger\Core\Repositories\Logger\Exceptions;
use Exception;
use Throwable;

class FailedToOpenStreamException extends Exception
{
    public function __construct($message = "Failed to open stream", $code = 0, Throwable $previous = null) 
    {
        parent::__construct($message, $code, $previous);
    }
}