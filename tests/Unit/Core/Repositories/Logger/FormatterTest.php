<?php

namespace Tests\Core\Repositories\Logger\Formatter;
use Exception;
use PHPUnit\Framework\TestCase;
use MadeiraMadeira\Logger\Core\Repositories\Logger\Formatter;

class FormatterTest extends TestCase
{
    public function testFormatWithContextEmpty()
    {

        $formatter = new Formatter("Dummy Project");

        $timestamp = date_format((new \DateTimeImmutable()), 'c');

        $normalized = $formatter->format([
            'level' => 'INFO',
            'message' => 'Mensagem',
            'global_event_timestamp' => $timestamp,
            'context' => []
        ]);

        $expected = [
            'level' => 'INFO',
            'message' => 'Mensagem',
            'global_event_timestamp' => $timestamp,
            'service_name' => 'Dummy Project',
        ];

        $this->assertEquals(
            $expected, 
            json_decode($normalized, true)
        );
    }

    public function testFormatWithContext()
    {

        $formatter = new Formatter("Dummy Project");

        $timestamp = date_format((new \DateTimeImmutable()), 'c');

        $normalized = $formatter->format([
            'level' => 'INFO',
            'message' => 'Mensagem',
            'global_event_timestamp' => $timestamp,
            'context' => [
                "teste" => "com contexto",
                "global_event_name" => "evento",
                "trace_id" => "123",
                "session_id" => "123"
            ]
        ]);

        $expected = [
            'level' => 'INFO',
            'message' => 'Mensagem',
            'global_event_timestamp' => $timestamp,
            'service_name' => 'Dummy Project',
            'context' => [
                'teste' => 'com contexto'
            ],
            "global_event_name" => "evento",
            "trace_id" => "123",
            "session_id" => "123"
        ];

        $this->assertEquals(
            $expected, 
            json_decode($normalized, true)
        );
    }
}