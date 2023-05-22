<?php

namespace Tests\Core;

use MadeiraMadeira\Logger\Core\Config;
use MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface;
use MadeiraMadeira\Logger\Core\LoggerStatic;
use PHPUnit\Framework\TestCase;

class LoggerStaticTest extends TestCase
{

    public function testGetInstance()
    {
        $logger = LoggerStatic::getInstance();
    
        $this->assertInstanceOf(LoggerInterface::class, $logger, "Should return a logger interface");
    }
}