<?php

namespace MadeiraMadeira\Logger\Core\Repositories\Logger;

use MadeiraMadeira\Logger\Core\Repositories\Logger\Exceptions\FailedToOpenStreamException;
use MadeiraMadeira\Logger\Core\Repositories\Logger\Logger;

class Handler
{
    /**
     * @var int $level
     */
    private $level;

    private $stream;

    private $formatter;

    private $url;

    /**
     * @param string $url
     * @param int $level
     */
    public function __construct($url, $level)
    {
        $this->url = $url;
        $this->level = Logger::toLoggerLevel($level);
    }

    /**
     * @param \MadeiraMadeira\Logger\Core\Repositories\Logger\Formatter $formatter
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
    public function handle($record)
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
    public function isHandling($level)
    {
        return $level >= $this->level;
    }
}