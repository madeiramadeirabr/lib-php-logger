<?php

namespace MadeiraMadeira\Logger\Core;

use JsonSerializable;
use MadeiraMadeira\Logger\Core\Interfaces\FormatterInterface;
use Throwable;

class Formatter implements FormatterInterface
{

    /**
     * @var int
     */
    private $maxDepth = 5;

    /**
     * @var string
     */
    private $serviceName;

    public function __construct($serviceName)
    {
        $this->serviceName = $serviceName;
    }
    
    /**
     * @param array $record
     * @return string|bool
     */
    public function format($record)
    {
        $normalized = $this->normalize($record);

        if (empty($normalized['context'])) {
            unset($normalized['context']);
        }
        
        return $this->toJson($normalized);
    }

    /**
     * @param mixed $data
     * @param int|null $depth
     * @return @mixed
     */
    private function normalize($data, int $depth = 0)
    {
        if ($depth > $this->maxDepth) {
            return $data;
        }
        
        $isFirstDepth = $depth == 0;
        
        if ($isFirstDepth) {
            return $this->normalizeFirstDepth($data);
        }
        
        if (is_array($data)) {
            return $this->normalizeArray($data, $depth);
        }

        if (is_object($data)) {
            return $this->normalizeObject($data);
        }
        
        return $data;
    }

    /**
     * @param array $data
     * @param int @depth
     * @return array
     */
    private function normalizeArray($data, $depth)
    {
        $normalized = [];

        foreach($data as $key => $value) {
            $normalized[$key] = $this->normalize($value, $depth + 1);
        }

        return $normalized;
    }

    /**
     * @param array $data
     * @return array
     */
    private function normalizeFirstDepth(array $data)
    {
        $depth = 0;
        $normalized = [
            'level' => $data['level'],
            'message' => $data['message'],
            'global_event_timestamp' => $data['global_event_timestamp'],
            'service_name' => $this->serviceName,
        ];

        if (!empty($data['global_event_name'])) {
            $normalized['global_event_name'] = $data['global_event_name'];
        }

        if (!empty($data['context']['trace_id'])) {
            $normalized['trace_id'] = $data['context']['trace_id'];
            unset($data['context']['trace_id']);
        }

        if (!empty($data['context']['session_id'])) {
            $normalized['session_id'] = $data['context']['session_id'];
            unset($data['context']['session_id']);
        }

        $normalized['context'] = $this->normalizeArray($data['context'], $depth + 1);

        return $normalized;
    }

    /**
     * @param mixed $record
     * @return string
     */
    private function toJson($record)
    {
        return json_encode(
            $record, 
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | 
            JSON_PRESERVE_ZERO_FRACTION | JSON_PARTIAL_OUTPUT_ON_ERROR
        );
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    private function normalizeObject($value)
    {
        if ($value instanceof JsonSerializable) {
            return $value;
        }

        if ($value instanceof Throwable) {
            return $this->normalizeException($value);
        }

        return $value;
    }

    /**
     * @param \Exception $e
     * @return array
     */
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