<?php

namespace MadeiraMadeira\Logger\Core;


class Config
{
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
        $this->level = $args['level'] ?? 'INFO';
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
     * @param string $level
     */
    public function setLevel(string $level)
    {
        $this->level = $level;
    }
    
    /**
     * @param string $serviceName
     */
    public function setServiceName(string $serviceName)
    {
        $this->serviceName = $serviceName;
    }
    
    /**
     * @param string $streamHandler
     */
    public function setStreamHandler(string $streamHandler)
    {
        $this->streamHandler = $streamHandler;
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