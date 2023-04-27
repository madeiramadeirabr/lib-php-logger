<?php

namespace MadeiraMadeira\Logger\Core\Repositories\Logger;

use MadeiraMadeira\Logger\Core\Repositories\Logger\Logger;

class Handler
{
    /**
     * @var int $level
     */
    private $level;

    private $stream;

    private $formatter;

    public function __construct($level)
    {
        $this->level = Logger::toLoggerLevel($level);
    }

    public function setFormatter($formatter)
    {
        $this->formatter = $formatter;
    }

    public function handle($record)
    {
        if (!$this->stream) {
            $this->stream = fopen("php://stdout", "a");
        }

        $formatedRecord = $this->formatter->format($record);

        $this->write($formatedRecord);
    }

    private function write($record)
    {
        fwrite($this->stream, (string) $record);
    }

    public function isHandling($level)
    {
        return $level >= $this->level;
    }
}