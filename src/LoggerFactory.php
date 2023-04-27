<?php

namespace MadeiraMadeira\Logger;

use MadeiraMadeira\Logger\Core\Config;
use MadeiraMadeira\Logger\Core\Logger as MMLogger;
use MadeiraMadeira\Logger\Core\Repositories\Logger\Logger as Logger;
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

        return new MMLogger(
            $this->createLogger($config)
        );
    }

    private function createLogger(Config $config)
    {
        return new Logger($config);
    }
}