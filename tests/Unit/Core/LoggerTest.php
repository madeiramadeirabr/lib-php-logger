<?php

namespace Tests\Unit\Core;

use MadeiraMadeira\Logger\Core\Logger;
use PHPUnit\Framework\TestCase;
use Tests\Mock\LoggerRepositoryMock;

class LoggerTest extends TestCase
{
    private static $logger;

    public function setUp(): void
    {
        self::$logger = new Logger(new LoggerRepositoryMock());
    }

    public function testEmergency()
    {
        $logger = self::$logger;
        $logger->emergency("Emergency test", []);

        $this->assertTrue(true);
    }
    public function testError()
    {
        $logger = self::$logger;
        $logger->error("Error test", []);

        $this->assertTrue(true);
    }

    public function testInfo()
    {
        $logger = self::$logger;
        $logger->info("Info test", []);

        $this->assertTrue(true);
    }

    public function testDebug()
    {
        $logger = self::$logger;
        $logger->debug("Debug test", []);

        $this->assertTrue(true);
    }

    public function testWarning()
    {
        $logger = self::$logger;
        $logger->warning("Warning test", []);

        $this->assertTrue(true);
    }
}