<?php

namespace Tests\Unit\Core;

use MadeiraMadeira\Logger\Core\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{

        public function testConfig()
        {
            $config = new Config();
            $this->assertEquals(
                $config->toArray(), 
                [
                    'streamHandler' => 'php://stdout',
                    'level' => "INFO",
                    'serviceName' => 'A dummy Project'
                ],
                "Should return a Config Object with default parameters"
            );
    
            $config = new Config([
                "serviceName" => "teste"
            ]);
            
            $this->assertEquals(
                $config->toArray(), 
                [
                    'streamHandler' => 'php://stdout',
                    'level' => "INFO",
                    'serviceName' => 'teste'
                ],
                "Should return a Config Object with service name \"teste\""
            );
    
            $config = new Config([
                "level" => "ERROR"
            ]);
            
            $this->assertEquals(
                $config->toArray(), 
                [
                    'streamHandler' => 'php://stdout',
                    'level' => "ERROR",
                    'serviceName' => 'A dummy Project'
                ],
                "Should return a Config Object with level ERROR"
            );
    
            $config = new Config([
                'streamHandler' => './path/to/file',
            ]);
            
            $this->assertEquals(
                $config->toArray(), 
                [
                    'streamHandler' => './path/to/file',
                    'level' => "INFO",
                    'serviceName' => 'A dummy Project'
                ],
                "Should return a Config Object with stream handler changed"
            );
        }
}