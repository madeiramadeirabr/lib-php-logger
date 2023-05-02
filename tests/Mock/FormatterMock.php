<?php

namespace Tests\Mock;
use MadeiraMadeira\Logger\Core\Interfaces\FormatterInterface;

class FormatterMock implements FormatterInterface
{
    public function format(array $array) {
        return json_encode($array, true);
    }
}