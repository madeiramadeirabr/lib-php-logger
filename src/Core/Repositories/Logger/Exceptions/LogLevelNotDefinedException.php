<?php

namespace MadeiraMadeira\Logger\Core\Repositories\Logger\Exceptions;
use Exception;
use Throwable;

class LogLevelNotDefinedException extends Exception
{
    public function __construct($message = "Log Level not defined", $code = 0, Throwable $previous = null) 
    {
        parent::__construct($message, $code, $previous);
    }
}