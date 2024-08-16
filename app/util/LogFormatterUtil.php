<?php

namespace app\util;

use Monolog\Formatter\LineFormatter;

class LogFormatterUtil extends LineFormatter
{
    public function __construct()
    {
        $format = "[%datetime%][%level_name%]%message% %context% %extra%\n";
        parent::__construct($format, 'Y-m-d H:i:s', true, true, true);
    }
}
