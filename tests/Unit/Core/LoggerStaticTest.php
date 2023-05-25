<?php

namespace Tests\Core;

use MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface;
use MadeiraMadeira\Logger\Core\LoggerStatic;
use PHPUnit\Framework\TestCase;

class LoggerStaticTest extends TestCase
{

    public function testTrace()
    {
        $this->assertTrue(method_exists(LoggerStatic::class, "trace"));
    }
    
    public function testDebug()
    {
        $this->assertTrue(method_exists(LoggerStatic::class, "debug"));
    }

    public function testInfo()
    {
        $this->assertTrue(method_exists(LoggerStatic::class, "info"));
    }

    public function testWarning()
    {
        $this->assertTrue(method_exists(LoggerStatic::class, "warning"));
    }

    public function testError()
    {
        $this->assertTrue(method_exists(LoggerStatic::class, "error"));
    }

    public function testEmergency()
    {
        $this->assertTrue(method_exists(LoggerStatic::class, "emergency"));
    }
}