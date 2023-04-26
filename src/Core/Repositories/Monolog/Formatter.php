<?php declare(strict_types=1);

namespace MadeiraMadeira\Logger\Core\Repositories\Monolog;

use Monolog\Formatter\JsonFormatter;


class Formatter extends JsonFormatter
{
    /**
     * @var string
     */
    private $serviceName;
    
    /**
     * @param string $serviceName
     * @return void
     */
    public function __construct(string $serviceName)
    {
        $this->serviceName = $serviceName;
    }

    /**
     * @param array $data
     * @param int|null $depth
     * @return mixed
     */
    public function normalize($data, int $depth = 0)
    {
        if ($depth != 0) {
            return parent::normalize($data, $depth);
        }

        $rfc = [
            'message' => $data['message'],
            'level' => $data['level_name'],
            'global_event_timestamp' => date_format($data['datetime'], 'c'),
            'service_name' => $this->serviceName
        ];

        if (!empty($data['context']['global_event_name'])) {
            $rfc['global_event_name'] = $data['context']['global_event_name'];
            unset($data['context']['global_event_name']);
        }
        if (!empty($data['context']['session_id'])) {
            $rfc['session_id'] = $data['context']['session_id'];
            unset($data['context']['session_id']);
        }
        if (!empty($data['context']['trace_id'])) {
            $rfc['trace_id'] = $data['context']['trace_id'];
            unset($data['context']['trace_id']);
        }
        if (!empty($data['context'])) {
            $rfc['context'] = $data['context'];
        }

        return parent::normalize($rfc, $depth);
    }
}