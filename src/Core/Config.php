<?php declare(strict_types=1);

namespace MadeiraMadeira\Logger\Core;


class Config
{
    /**
     * @var array
     */
    private static $levels = [
        'DEBUG',
        'INFO',
        'WARNING',
        'ERROR',
        'EMERGENCY'
    ];

    /**
     * @var string
     */
    private $streamHandler;

    /**
     * @var string
     */
    private $level;
    
    /**
     * @var string
     */
    private $serviceName;

    /**
     * @param array $args
     * @return void
     */
    public function __construct(array $args = array())
    {
        $this->streamHandler = $args['streamHandler'] ?? 'php://stdout';
        $this->serviceName = $args['serviceName'] ?? $_SERVER['APP_NAME'] ?? "A dummy Project";

        $this->level = 'INFO';

        if (isset($args['level']) && in_array($args['level'], self::$levels)) {
            $this->level = $args['level'];
        }
    }

    /**
     * @return string
     */
    public function getStreamHandler()
    {
        return $this->streamHandler;
    }

    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'streamHandler' => $this->getStreamHandler(),
            'level' => $this->getLevel(),
            'serviceName' => $this->getServiceName()
        ];
    }
}