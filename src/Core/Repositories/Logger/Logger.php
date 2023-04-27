<?php

namespace MadeiraMadeira\Logger\Core\Repositories\Logger;

use MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface;
use MadeiraMadeira\Logger\Core\Config;
use MadeiraMadeira\Logger\Core\Repositories\Logger\Exceptions\LogLevelNotDefinedException;
use MadeiraMadeira\Logger\Core\Repositories\Logger\Handler;
use MadeiraMadeira\Logger\Core\Repositories\Logger\Formatter;
class Logger implements LoggerInterface
{
    /**
     *  @var \MadeiraMadeira\Logger\Core\Repositories\Logger\Handler
     */
    private $handler;

    public const TRACE = 0;
    public const DEBUG = 1;
    public const INFO = 2;
    public const WARNING = 3;
    public const ERROR = 4;
    public const EMERGENCY = 5;

    public const LEVELS = [
        self::TRACE => 'TRACE',
        self::DEBUG => 'DEBUG',
        self::INFO => 'INFO',
        self::WARNING => 'WARNING',
        self::ERROR => 'ERROR',
        self::EMERGENCY => 'EMERGENCY'
    ];

    /**
     * @param \MadeiraMadeira\Logger\Core\Config $config
     * @return void
     */
    public function __construct(Config $config)
    {
        $handler = new Handler(
            $config->getLevel()
        );
        
        $handler->setFormatter(
            new Formatter($config->getServiceName())
        );

        $this->handler = $handler;
    }


    /**
     * @param int $level
     * @param string $message
     * @param array $args 
     * @return void
     */
    public function addRecord($level, $message, $args)
    {
        if (!$this->handler->isHandling($level)) {
            return;
        }

        $record = [
            'level' => self::LEVELS[$level],
            'message' => $message,
            'context' => $args,
            'global_event_timestamp' =>  date_format((new \DateTimeImmutable()), 'c'),
        ];

        $this->handler->handle($record);
    }

    /**
     * @param int $level
     * @param string message
     * @param array|null args
     * @return void
     */
    private function log($level, string $message, array $args = array()): void
    {
        $this->addRecord($level, $message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function emergency(string $message, array $args = array()): void
    {
        $this->log(self::EMERGENCY, $message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function error(string $message, array $args = array()): void
    {
        $this->log(self::ERROR, $message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function warning(string $message, array $args = array()): void
    {
        $this->log(self::WARNING, $message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function info(string $message, array $args = array()): void
    {
        $this->log(self::INFO, $message, $args);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function debug(string $message, array $args = array()): void
    {
        $this->log(self::DEBUG, $message, $args);
    }   

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function trace(string $message, array $args = array()): void
    {
        $this->log(self::TRACE, $message, $args);
    }   

    /**
     * @param string
     * @return int
     */
    public static function toLoggerLevel($level)
    {
        $levels = self::LEVELS;
        $level = strtoupper($level);

        if (!in_array($level, $levels)) {
            throw new LogLevelNotDefinedException("Log level \"$level\" is not defined, use one of: ". implode(", ", array_values($levels)));
        }

        return array_flip($levels)[$level];
    }
}