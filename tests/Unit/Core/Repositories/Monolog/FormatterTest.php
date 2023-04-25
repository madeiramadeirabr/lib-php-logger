<?php

namespace Tests\Unit\Core\Repostories\Monolog;

use MadeiraMadeira\Logger\Core\Repositories\Monolog\Formatter;
use PHPUnit\Framework\TestCase;
use DateTimeImmutable;

class FormatterTest extends TestCase
{
    private static $payloadBeforeNormalized;
    private static $payloadAfterNormalized;

    public function setUp(): void
    {
        parent::setUp();

        self::$payloadBeforeNormalized = [
            'message' => 'teste',
            'level_name' => 'INFO',
            'datetime' => new DateTimeImmutable(),
            'context' => [
                'teste' => '123',
                'atributo' => 'valor',
                'session_id' => '12345',
                'trace_id' => '4567',
                'global_event_name' => 'aaaaa'
            ]
        ];
        self::$payloadAfterNormalized = [
            'message' => 'teste',
            'level' => 'INFO',
            'global_event_timestamp' => date_format(self::$payloadBeforeNormalized['datetime'], 'c'),
            'global_event_name' => 'aaaaa',
            'service_name' => 'A Dummy Project',
            'session_id' => '12345',
            'trace_id' => '4567',
            'context' => [
                'teste' => '123',
                'atributo' => 'valor'
            ]
        ];
    }

    public function testNormalize(): void
    {
        $formatter = new Formatter("A Dummy Project");

        $normalizedData = $formatter->normalize(self::$payloadBeforeNormalized);

        $this->assertEquals(
            $normalizedData, 
            self::$payloadAfterNormalized    
        );
    }

}