<?php

namespace Tests\Core\Repositories\Logger\Logger;

use MadeiraMadeira\Logger\Core\Config;
use MadeiraMadeira\Logger\Core\Repositories\Logger\Exceptions\LogLevelNotDefinedException;
use MadeiraMadeira\Logger\Core\Repositories\Logger\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    private static $logger;

    public function setUp(): void
    {
        self::$logger = $this->getMockBuilder(Logger::class)
                            ->setConstructorArgs([new Config()])
                            ->getMock();
    }

    public function testTrace()
    {
        $this->assertTrue(
            method_exists(self::$logger, 'trace'),
            "Class does not have method trace"
        );
    }
    public function testDebug()
    {
        $this->assertTrue(
            method_exists(self::$logger, 'debug'),
            "Class does not have method debug"
        );

        self::$logger->expects($this->once())
                    ->method('debug')
                    ->with(
                        // $this->equalTo(Logger::DEBUG), 
                        $this->equalTo('Debug test'), 
                        $this->equalTo([]
                    ));

        self::$logger->debug("Debug test");
    }
    public function testInfo()
    {
        $this->assertTrue(
            method_exists(self::$logger, 'info'),
            "Class does not have method info"
        );
    }
    public function testWarning()
    {
        $this->assertTrue(
            method_exists(self::$logger, 'warning'),
            "Class does not have method warning"
        );
        
    }
    public function testError()
    {
        $this->assertTrue(
            method_exists(self::$logger, 'error'),
            "Class does not have method error"
        );
        
    }
    public function testEmergency()
    {
        $this->assertTrue(
            method_exists(self::$logger, 'emergency'),
            "Class does not have method emergency"
        );
        
    }

    public function testToLoggerLevel()
    {
        $levels = [
            'TRACE',
            'DEBUG',
            'INFO',
            'WARNING',
            'ERROR',
            'EMERGENCY'
        ];

        foreach($levels as $key => $value) {
            $this->assertEquals(Logger::toLoggerLevel($value), $key);
        }

        $this->expectException(
            LogLevelNotDefinedException::class
        );
        
        Logger::toLoggerLevel("undefined log level");
    }
}