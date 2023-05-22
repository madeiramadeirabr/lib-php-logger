<?php

namespace Tests\Core;

use MadeiraMadeira\Logger\Core\Logger;
use PHPUnit\Framework\TestCase;
use Tests\Mock\HandlerMock;

class LoggerTest extends TestCase
{
    public function getLoggerMock($handler = null)
    {
        $builder = $this->getMockBuilder(Logger::class)
                        ->setConstructorArgs([$handler ?? $this->getHandlerMock([])]);

        if (version_compare(PHP_VERSION, "7.2.0") >= 0) {
            $builder->onlyMethods([
                'addRecord'
            ]);
        } else {
            $builder->setMethods([
                'addRecord'
            ]);
        }

        return $builder->getMock();
    }

    public function getHandlerMock($methodsList)
    {
        $builder = $this->getMockBuilder(HandlerMock::class);

        if (version_compare(PHP_VERSION, "7.2.0") >= 0) {
            $builder->onlyMethods($methodsList);
        } else {
            $builder->setMethods($methodsList);
        }

        return $builder->getMock();
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
        $handler = $this->getHandlerMock(['isHandling']);

        $logger = new Logger($handler);

        $handler->expects($this->once())
            ->method('isHandling')
            ->with(Logger::INFO)
            ->willReturn(true);

        $logger->addRecord(Logger::INFO, "message", [], "");
    }

    public function testAddRecordCallingHandle()
    {
        $handler = $this->getHandlerMock(['handle']);

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