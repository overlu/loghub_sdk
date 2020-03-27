<?php

namespace Overlu\Log\Drivers;

use Overlu\Log\Driver;
use Overlu\Log\Utils\Request;

class Error extends Driver
{
    public function push($code, string $message, string $file, int $line, string $type = 'error')
    {
        $error_log_data = [
            'site_id' => $this->getSiteId(),
            'project_code' => $this->getProjectCode(),
            'code' => $code,
            'message' => $message,
            'file' => $file,
            'line' => $line,
            'type' => $type,
        ];

        return Request::post(env('LOGHUB_SERVER') . '/api/logs/error', $error_log_data);

    }

}
