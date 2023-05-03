<?php

namespace MadeiraMadeira\Logger\Core;

use MadeiraMadeira\Logger\Core\Interfaces\HandlerInterface;
use MadeiraMadeira\Logger\Core\Exceptions\FailedToOpenStreamException;
use MadeiraMadeira\Logger\Core\Logger;

class Handler implements HandlerInterface
{
    /**
     * @var int $level
     */
    private $level;

    private $stream;

    /**
     * @var \MadeiraMadeira\Logger\Core\Interfaces\FormatterInterface
     */
    private $formatter;
    
    /**
     * @var string
     */
    private $url;

    /**
     * @param string $url
     * @param string $level
     * @param \MadeiraMadeira\Logger\Core\Interfaces\FormatterInterface
     */
    public function __construct(string $url, string $level, $formatter)
    {
        $this->url = $url;
        $this->level = Logger::toLoggerLevel($level);
        $this->setFormatter($formatter);
    }

    /**
     * @param \MadeiraMadeira\Logger\Core\Interfaces\FormatterInterface $formatter
     * @return void
     */
    public function setFormatter($formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @param array $record
     * @return bool
     */
    public function handle(array $record)
    {
        $success = true;
        try{
            if (!is_resource($this->stream)) {
                $this->stream = fopen($this->url, "a");
                
                if (!is_resource($this->stream)) {
                    throw new FailedToOpenStreamException("Failed to open stream");
                }
            }
            
            $formatedRecord = $this->formatter->format($record);
            $this->write($formatedRecord);
        
        }catch(\Exception $e) {
            $success = false;
        }

        return $success;
    }

    /**
     * @param mixed $record
     * @return void
     */
    private function write($record)
    {
        fwrite($this->stream, (string) $record);
    }

    /**
     * @param int $level
     * @return bool
     */
    public function isHandling(int $level)
    {
        return $level >= $this->level;
    }
}