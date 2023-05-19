<?php

namespace Tests\Unit;

use MadeiraMadeira\Logger\Core\Config;
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
    
    public function testCreateLoggerInstanceWithConfig()
    {
        $factory = new LoggerFactory();
        
        $config = new Config([
            'serviceName' => 'Nome alternativo',
            'level' => 'ERROR',
            'streamHandler' => '/tmp/arquivo.txt'
        ]);

        $logger = $factory->createLoggerInstance($config);
    
        $this->assertInstanceOf(LoggerInterface::class, $logger, "Should return a LoggerInterface");
    }
}
