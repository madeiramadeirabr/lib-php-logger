<?php

namespace Tests\Core\Handler;

use MadeiraMadeira\Logger\Core\Handler;
use PHPUnit\Framework\TestCase;
use Tests\Mock\FormatterMock;
class HandlerTest extends TestCase
{
    public function testIsHandling()
    {
        $levels = [
            'TRACE' => 0,
            'DEBUG' => 1,
            'INFO' => 2,
            'WARNING' => 3,
            'ERROR' => 4,
            'EMERGENCY' => 5,
        ];
        
        $mock = new FormatterMock();
        
        foreach ($levels as $levelConfigured => $valueConfigurated) {
            $handler = new Handler('php://stdout', $levelConfigured, $mock);
            
            foreach ($levels as $valuePrintted) {
                $this->assertEquals($handler->isHandling($valuePrintted), $valuePrintted >= $valueConfigurated);
            }
        }
    }

    public function testHandleCallingFormatter()
    {
        $mock = $this->getMockBuilder(FormatterMock::class)
                    ->onlyMethods([
                        'format'
                    ])
                    ->getMock();

        $handler = new Handler("php://memory", 1, $mock);

        $mock->expects($this->once())
            ->method('format')
            ->withAnyParameters()
            ->willReturn(json_encode([
                'campo',
                'campo2',
                'campo3'
            ]));
        
        $result = $handler->handle([]);
        
        $this->assertTrue($result, "Should return true when format success");
    }

    public function testHandleThrowingException()
    {
        $handler = $this->getMockBuilder(Handler::class)
                     ->onlyMethods([
                        'openStream'
                     ])
                     ->setConstructorArgs(['', 1, new FormatterMock])
                     ->getMock();

        $handler->expects($this->once())
                ->method('openStream')
                ->willReturn(false);

        $result = $handler->handle([123]);

        $this->assertFalse($result, "Should return false when throw any exception");
    }

    public function testOpenStream()
    {
        $handler = new Handler("php://memory", 1, new FormatterMock);

        $resource = $handler->openStream();
    
        $this->assertIsResource($resource, "Should return a resource");
    }

    public function testWrite()
    {
        $handler = new Handler("php://memory", 1, new FormatterMock);
        $handler->handle(['test']);

        $handle = $handler->getStream();
        fseek($handle, 0);
        
        $this->assertEquals((string) json_encode(['test'], true), fread($handle, 100), "Should write to stream");
    }
}