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
        self::$logger = $this->getMockBuilder(Logger::class)
                            ->setConstructorArgs([new LoggerRepositoryMock()])
                            ->getMock();
    }

    public function testEmergency()
    {
        $logger = self::$logger;

        $logger->expects($this->once())
                ->method('emergency')
                ->with(
                    $this->equalTo('Emergency test'), 
                    $this->equalTo([]
                ));

        $logger->emergency("Emergency test");
    }
    public function testError()
    {
        $logger = self::$logger;

        $logger->expects($this->once())
                ->method('error')
                ->with(
                    $this->equalTo('Error test'), 
                    $this->equalTo([]
                ));

        $logger->error("Error test");
    }

    public function testInfo()
    {
        $logger = self::$logger;

        $logger->expects($this->once())
                ->method('info')
                ->with(
                    $this->equalTo('Info test'), 
                    $this->equalTo([]
                ));

        $logger->info("Info test");
    }

    public function testDebug()
    {
        $logger = self::$logger;

        $logger->expects($this->once())
                ->method('debug')
                ->with(
                    $this->equalTo('Debug test'), 
                    $this->equalTo([]
                ));

        $logger->debug("Debug test");
    }

    public function testWarning()
    {
        $logger = self::$logger;

        $logger->expects($this->once())
                ->method('warning')
                ->with(
                    $this->equalTo('Warning test'), 
                    $this->equalTo([]
                ));

        $logger->warning("Warning test");
    }
}