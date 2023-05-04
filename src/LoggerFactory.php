<?php

namespace MadeiraMadeira\Logger;

use MadeiraMadeira\Logger\Core\Config;
use MadeiraMadeira\Logger\Core\Formatter;
use MadeiraMadeira\Logger\Core\Handler;
use MadeiraMadeira\Logger\Core\Logger ;
class LoggerFactory
{
    /**
     * @param \MadeiraMadeira\Logger\Core\Config|null $config
     * @return \MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface
     */
    public function createLoggerInstance(Config $config = null)
    {
        if (!$config) {
            $config = new Config();
        }
        
        return $this->createLogger($config);
    }
    
    /**
     * @param \MadeiraMadeira\Logger\Core\Config $config
     * @return \MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface
     */
    private function createLogger(Config $config)
    {
        $handler = new Handler(
            $config->getStreamHandler(),
            $config->getLevel(),
            new Formatter(
                $config->getServiceName()
            )
        );

        return new Logger(
            $handler
        );
    }
    
}