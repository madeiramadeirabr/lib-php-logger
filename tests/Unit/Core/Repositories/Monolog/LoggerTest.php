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