<?php

namespace MadeiraMadeira\Logger\Core;

use MadeiraMadeira\Logger\LoggerFactory;

class LoggerStatic
{

    /**
     * @var \MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface
     */
    private static $logger;

    /**
     * @var \MadeiraMadeira\Logger\Core\Config $config
     */
    private static $config;

    private function __construct()
    {
    }

    /**
     * @return \MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface
     */
    public static function getInstance()
    {
        if (self::$logger) {
            return self::$logger;
        }

        self::$logger = (new LoggerFactory)->createLoggerInstance(self::$config);

        return self::$logger;
    }

    /**
     * @param \MadeiraMadeira\Logger\Core\Config $config
     */
    public static function setConfig($config): void
    {
        self::$config = $config;
    }

    /**
     * @param string message
     * @param array|null args
     * @param string globalEventName
     * @return void
     */
    public static function emergency(string $message, array $args = array(), string $globalEventName = ""): void
    {
        self::getInstance()->emergency($message, $args, $globalEventName);
    }

    /**
     * @param string message
     * @param array|null args
     * @param string globalEventName
     * @return void
     */
    public static function error(string $message, array $args = array(), string $globalEventName = ""): void
    {
        self::getInstance()->error($message, $args, $globalEventName);
    }

    /**
     * @param string message
     * @param array|null args
     * @param string globalEventName
     * @return void
     */
    public static function warning(string $message, array $args = array(), string $globalEventName = ""): void
    {
        self::getInstance()->warning($message, $args, $globalEventName);
    }

    /**
     * @param string message
     * @param array|null args
     * @param string globalEventName
     * @return void
     */
    public static function info(string $message, array $args = array(), string $globalEventName = ""): void
    {
        self::getInstance()->info($message, $args, $globalEventName);
    }

    /**
     * @param string message
     * @param array|null args
     * @param string globalEventName
     * @return void
     */
    public static function debug(string $message, array $args = array(), string $globalEventName = ""): void
    {
        self::getInstance()->debug($message, $args, $globalEventName);
    }

    /**
     * @param string message
     * @param array|null args
     * @param string globalEventName
     * @return void
     */
    public static function trace(string $message, array $args = array(), string $globalEventName = ""): void
    {
        self::getInstance()->trace($message, $args, $globalEventName);
    }
}
