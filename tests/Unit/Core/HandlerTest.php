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
            'LEVEL ERROR NAO EXISTE' => null
        ];
        
        $mock = new FormatterMock();

        $handler = new Handler('php://stdout', 'INFO', $mock);
        $this->assertFalse($handler->isHandling($levels['DEBUG']));
        $this->assertTrue($handler->isHandling($levels['WARNING']));
        
    }
    
    public function testHandle()
    {
        $mock = new FormatterMock();
        $handler = new Handler('php://stdout', 'INFO', $mock);
        $this->assertTrue(
            $handler->handle([123])
        );
    }
}