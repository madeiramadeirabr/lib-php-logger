<?php declare(strict_types=1);

namespace MadeiraMadeira\Logger\Core\Repositories\Monolog;

use MadeiraMadeira\Logger\Core\Config;
use MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface;
use MadeiraMadeira\Logger\Core\Repositories\Monolog\Formatter;

use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;


class Logger implements LoggerInterface
{

    /**
     * @var \Monolog\Logger
     */
    private $logger;

    /**
     *  @var \MadeiraMadeira\Logger\Core\Config
     */
    private Config $config;

    /**
     * @param \MadeiraMadeira\Logger\Core\Config $config
     * @return void
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return \Monolog\Logger
     */
    private function createLogger(): MonoLogger
    {
        $handler = new StreamHandler(
            $this->config->getStreamHandler(),
            $this->config->getLevel(),
        );
        $handler->setFormatter(
            new Formatter($this->config->getServiceName())
        );

        $monolog = new MonoLogger($this->config->getServiceName());
        $monolog->pushHandler($handler);

        return $monolog;
    }

    /**
     * @return \Monolog\Logger;
     */
    public function getLogger(): MonoLogger
    {
        if (!$this->logger) {
            $this->logger = $this->createLogger();
        }
        
        return $this->logger;
    }

    /**
     * @param int $level
     * @param string message
     * @param array|null args
     * @return void
     */
    private function log($level, string $message, array $args = array()): void
    {
        $this->getLogger()->addRecord($level, $message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function emergency(string $message, array $args = array()): void
    {
        $this->log(MonoLogger::EMERGENCY, $message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function error(string $message, array $args = array()): void
    {
        $this->log(MonoLogger::ERROR, $message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function warning(string $message, array $args = array()): void
    {
        $this->log(MonoLogger::WARNING, $message, $args);
    }

    public function info(string $message, array $args = array()): void
    {
        $this->log(MonoLogger::INFO, $message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function debug(string $message, array $args = array()): void
    {
        $this->log(MonoLogger::DEBUG, $message, $args);
    }    
}