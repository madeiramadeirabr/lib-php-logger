<?php

namespace Tests\Mock;

use MadeiraMadeira\Logger\Core\Interfaces\HandlerInterface;

class HandlerMock implements HandlerInterface
{

    public function __construct()
    {
    }

    /**
     * @param \MadeiraMadeira\Logger\Core\Interfaces\FormatterInterface $formatter
     * @return void
     */
    public function setFormatter($formatter)
    {
    }

    /**
     * @param array $record
     * @return bool
     */
    public function handle(array $record): bool
    {
        return true;
    }

    /**
     * @param int $level
     * @return bool
     */
    public function isHandling(int $level)
    {
        return true;
    }
}