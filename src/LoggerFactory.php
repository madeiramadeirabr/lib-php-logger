<?php

namespace MadeiraMadeira\Logger;

use MadeiraMadeira\Logger\Core\Config;
use MadeiraMadeira\Logger\Core\Logger as MMLogger;
use MadeiraMadeira\Logger\Core\Repositories\Monolog\Logger as MonoLogger;

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
            $this->createMonoLogger($config)
        );
    }

    /**
     * @param \MadeiraMadeira\Logger\Core\Config|null $config
     * @return \MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface
     */
    private function createMonoLogger(Config $config)
    {
        return new MonoLogger($config);
    }
}