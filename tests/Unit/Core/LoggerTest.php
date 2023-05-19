<?php

namespace Tests\Core;

use MadeiraMadeira\Logger\Core\Interfaces\HandlerInterface;
use MadeiraMadeira\Logger\Core\Logger;
use PHPUnit\Framework\TestCase;
use Tests\Mock\HandlerMock;

class LoggerTest extends TestCase
{
    public function getLoggerMock($handler = null)
    {
        return $this->getMockBuilder(Logger::class)
            ->onlyMethods([
                'addRecord',
            ])
            ->setConstructorArgs([$handler ?? $this->getHandlerMock()])
            ->getMock();
    }

    public function getHandlerMock()
    {
        return $this->getMockBuilder(HandlerMock::class)
            ->getMock();
    }

    public function testTrace()
    {
        $logger = $this->getLoggerMock();

        $message = 'Mensagem';

        $logger->expects($this->once())
            ->method('addRecord')
            ->with(
                Logger::TRACE,
                $message,
                [],
                ''
            );

        $logger->trace($message, []);
    }

    public function testDebug()
    {
        $logger = $this->getLoggerMock();

        $message = 'Mensagem';

        $logger->expects($this->once())
            ->method('addRecord')
            ->with(
                Logger::DEBUG,
                $message,
                [],
                ''
            );

        $logger->debug($message, []);
    }
    public function testInfo()
    {
        $logger = $this->getLoggerMock();

        $message = 'Mensagem';

        $logger->expects($this->once())
            ->method('addRecord')
            ->with(
                Logger::INFO,
                $message,
                [],
                ''
            );

        $logger->info($message, []);
    }
    public function testWarning()
    {
        $logger = $this->getLoggerMock();

        $message = 'Mensagem';

        $logger->expects($this->once())
            ->method('addRecord')
            ->with(
                Logger::WARNING,
                $message,
                [],
                ''
            );

        $logger->warning($message, []);
    }
    public function testError()
    {
        $logger = $this->getLoggerMock();

        $message = 'Mensagem';

        $logger->expects($this->once())
            ->method('addRecord')
            ->with(
                Logger::ERROR,
                $message,
                [],
                ''
            );

        $logger->error($message, []);
    }
    public function testEmergency()
    {
        $logger = $this->getLoggerMock();

        $message = 'Mensagem';

        $logger->expects($this->once())
            ->method('addRecord')
            ->with(
                Logger::EMERGENCY,
                $message,
                [],
                ''
            );

        $logger->emergency($message, []);
    }

    public function testAddRecordCallingIsHandling()
    {
        $handler = $this->getMockBuilder(HandlerMock::class)
            ->onlyMethods([
                'isHandling'
            ])
            ->getMock();

        $logger = new Logger($handler);

        $handler->expects($this->once())
                ->method('isHandling')
                ->with(Logger::INFO)
                ->willReturn(true);

        $logger->addRecord(Logger::INFO, "message", [], "");
    }

    public function testAddRecordCallingHandle()
    {
        $handler = $this->getMockBuilder(HandlerMock::class)
            ->onlyMethods([
                'handle'
            ])
            ->getMock();

        $logger = new Logger($handler);

        $handler->expects($this->once())
            ->method('handle')
            ->withAnyParameters()
            ->willReturn(true);

        $result = $logger->addRecord(Logger::INFO, "message", [], "");

        $this->assertTrue($result, "Should return result of handle");
    }

    public function testToLoggerLevel()
    {
        $levels = [
            'TRACE' => 0,
            'DEBUG' => 1,
            'INFO' => 2,
            'WARNING' => 3,
            'ERROR' => 4,
            'EMERGENCY' => 5,
            'LEVEL ERROR NAO EXISTENTE' => null
        ];

        foreach ($levels as $key => $value) {
            $this->assertSame(Logger::toLoggerLevel($key), $value);
        }
    }
}
