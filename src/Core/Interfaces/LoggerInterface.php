<?php

namespace MadeiraMadeira\Logger\Core\Interfaces;

interface LoggerInterface 
{
    public function emergency(string $message, array $args = array(), string $globalEventName = "");

    public function error(string $message, array $args = array(), string $globalEventName = "");

    public function warning(string $message, array $args = array(), string $globalEventName = "");

    public function info(string $message, array $args = array(), string $globalEventName = "");

    public function debug(string $message, array $args = array(), string $globalEventName = "");

    public function trace(string $message, array $args = array(), string $globalEventName = "");

    public function setHandler($handler);
}

