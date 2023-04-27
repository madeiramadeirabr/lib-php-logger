<?php


namespace MadeiraMadeira\Logger\Core;

use MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface;

class Logger implements LoggerInterface
{
    /**
     * @var \MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function emergency(string $message, array $args = array())
    {
        $this->logger->emergency($message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function error(string $message, array $args = array())
    {
        $this->logger->error($message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function warning(string $message, array $args = array())
    {
        $this->logger->warning($message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function info(string $message, array $args = array())
    {
        $this->logger->info($message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function debug(string $message, array $args = array())
    {
        $this->logger->debug($message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function trace(string $message, array $args = array())
    {
        $this->logger->trace($message, $args);
    }

}