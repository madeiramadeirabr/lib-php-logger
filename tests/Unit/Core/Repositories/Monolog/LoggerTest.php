<?php

namespace Tests\Unit\Core\Repostories\Monolog;

use PHPUnit\Framework\TestCase;
use Monolog\Logger as MonoLogger;
use MadeiraMadeira\Logger\Core\Config;
use MadeiraMadeira\Logger\Core\Repositories\Monolog\Logger;

class LoggerTest extends TestCase
{
    private static $logger;

    public function setUp(): void
    {
        self::$logger = new Logger(new Config());
    }

    public function testGetLogger(): void
    {
        $logger = new Logger(new Config());

        $monolog = $logger->getLogger();

        $this->assertInstanceOf(
            MonoLogger::class, 
            $monolog,
            "Should return an Monolog Logger instance"
        );
    }

    public function testEmergency()
    {
        $this->assertTrue(
            method_exists(self::$logger, 'emergency'),
            "Class does not have method emergency"
        );
    }

    public function testError()
    {
        $this->assertTrue(
            method_exists(self::$logger, 'error'),
            "Class does not have method error"
        );
    }

    public function testInfo()
    {
        $this->assertTrue(
            method_exists(self::$logger, 'info'),
            "Class does not have method info"
        );
    }

    public function testDebug()
    {
        $this->assertTrue(
            method_exists(self::$logger, 'debug'),
            "Class does not have method debug"
        );
    }

    public function testWarning()
    {
        $this->assertTrue(
            method_exists(self::$logger, 'warning'),
            "Class does not have method warning"
        );
    }
}