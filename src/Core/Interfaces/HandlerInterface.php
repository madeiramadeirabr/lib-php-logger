<?php

namespace MadeiraMadeira\Logger\Core\Interfaces;

interface HandlerInterface 
{
    public function handle(array $record);

    public function isHandling(int $level);

    public function setFormatter($formatter);
}

