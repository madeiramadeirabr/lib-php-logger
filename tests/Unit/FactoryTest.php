<?php

namespace Tests\Unit;

use MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface;
use MadeiraMadeira\Logger\LoggerFactory;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testCreateLoggerInstance()
    {
        $factory = new LoggerFactory();

        $logger = $factory->createLoggerInstance();

        $this->assertInstanceOf(LoggerInterface::class, $logger, "Should return a LoggerInterface");
    }
}