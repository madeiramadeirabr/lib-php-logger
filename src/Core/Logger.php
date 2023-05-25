<?php

namespace MadeiraMadeira\Logger\Core;

use MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface;

class Logger implements LoggerInterface
{
    /**
     *  @var \MadeiraMadeira\Logger\Core\Interfaces\HandlerInterface
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
     * @param \MadeiraMadeira\Logger\Core\Interfaces\HandlerInterface $handler
     * @return void
     */
    public function __construct($handler)
    {
        $this->setHandler($handler);
    }

    
    /**
     * @param \MadeiraMadeira\Logger\Core\Interfaces\HandlerInterface $handler
     * @return void
     */
    public function setHandler($handler): void
    {
        $this->handler = $handler;
    }

    /**
     * @param int $level
     * @param string $message
     * @param array $args 
     * @return bool
     */
    public function addRecord(int $level, string $message, array $args, string $globalEventName): bool
    {
        if (!$this->handler->isHandling($level)) {
            return false;
        }

        $record = [
            'level' => self::LEVELS[$level],
            'message' => $message,
            'context' => $args,
            'global_event_timestamp' =>  date_format((new \DateTimeImmutable()), 'c'),
            'global_event_name' => $globalEventName
        ];

        return $this->handler->handle($record);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function emergency(string $message, array $args = array(), string $globalEventName = ""): void
    {
        $this->addRecord(self::EMERGENCY, $message, $args, $globalEventName);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function error(string $message, array $args = array(), string $globalEventName = ""): void
    {
        $this->addRecord(self::ERROR, $message, $args, $globalEventName);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function warning(string $message, array $args = array(), string $globalEventName = ""): void
    {
        $this->addRecord(self::WARNING, $message, $args, $globalEventName);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function info(string $message, array $args = array(), string $globalEventName = ""): void
    {
        $this->addRecord(self::INFO, $message, $args, $globalEventName);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function debug(string $message, array $args = array(), string $globalEventName = ""): void
    {
        $this->addRecord(self::DEBUG, $message, $args, $globalEventName);
    }

    /**
     * @param string message
     * @param array|null args
     * @return void
     */
    public function trace(string $message, array $args = array(), string $globalEventName = ""): void
    {
        $this->addRecord(self::TRACE, $message, $args, $globalEventName);
    }

    /**
     * Converts log level to numerical pattern, returns NULL in case of invalid value.
     *
     * @param string $level
     * @return int|null
     */
    public static function toLoggerLevel(string $level)
    {
        $levelNumber = array_search(strtoupper($level), self::LEVELS);

        return $levelNumber !== false ? $levelNumber : null;
    }
}
