<?php

namespace app\util;

use Monolog\Handler\RotatingFileHandler;

class LogFileHandlerUtil extends RotatingFileHandler
{
    public const FILE_PER_DAY = 'Ymd';
    public const FILE_PER_MONTH = 'Ym';
    public const FILE_PER_YEAR = 'Y';

    public function write(array $record): void
    {
        $traceId = empty(request()) ? get_cli_trace_id() : get_trace_id();

        $traceId = '[' . $traceId . ']';

        $message = $record['message'] ?? '';
        $formatted = $record['formatted'] ?? '';

        $record['message'] = $traceId . $message;
        if (strlen($formatted) > 21) {
            $record['formatted'] = substr_replace($formatted, $traceId, 21, 0);
        }

        parent::write($record);
    }
}
