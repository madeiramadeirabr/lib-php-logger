<?php

namespace MadeiraMadeira\Logger\Core\Interfaces;

interface LoggerInterface 
{
    public function emergency(string $message, array $args = array());

    public function error(string $message, array $args = array());

    public function warning(string $message, array $args = array());

    public function info(string $message, array $args = array());

    public function debug(string $message, array $args = array());

}

