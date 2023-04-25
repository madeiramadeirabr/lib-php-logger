<?php

namespace Tests\Mock;
use MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface;

class LoggerRepositoryMock implements LoggerInterface
{
    public function emergency(string $message, array $args = array()) {}

    public function error(string $message, array $args = array()) {}

    public function warning(string $message, array $args = array()) {}

    public function info(string $message, array $args = array()) {}

    public function debug(string $message, array $args = array()) {}
}