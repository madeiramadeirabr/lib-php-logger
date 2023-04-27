<?php

namespace MadeiraMadeira\Logger\Core\Repositories\Logger;

use Throwable;

class Formatter
{

    private $serviceName;

    public function __construct($serviceName)
    {
        $this->serviceName = $serviceName;
    }
    
    public function format($record)
    {
        $normalized = [
            'level' => $record['level'],
            'message' => $record['message'],
            'global_event_timestamp' => $record['global_event_timestamp'],
            'service_name' => $this->serviceName
        ];

        if (!empty($record['context']['global_event_name'])) {
            $normalized['global_event_name'] = $record['context']['global_event_name'];
            unset($record['context']['global_event_name']);
        }

        if (!empty($record['context']['trace_id'])) {
            $normalized['trace_id'] = $record['context']['trace_id'];
            unset($record['context']['trace_id']);
        }

        if (!empty($record['context']['session_id'])) {
            $normalized['session_id'] = $record['context']['session_id'];
            unset($record['context']['session_id']);
        }

        foreach ($record['context'] as $key => $value) {
            if (is_object($value)) {
                $normalized['context'][] = $this->normalizeObject($value);
            }
            else {
                $normalized['context'][$key] = $value;
            }

            
        }

        return json_encode($normalized, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
    }

    private function normalizeObject($value)
    {
        if ($value instanceof Throwable) {
            return $this->normalizeException($value);
        }

        return $value;
    }

    private function normalizeException($e)
    {
        return [
            'class' => get_class($e),
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile() . ':' . $e->getLine()
        ];
    }
}