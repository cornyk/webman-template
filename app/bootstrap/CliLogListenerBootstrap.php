<?php

namespace app\bootstrap;

use support\Log;
use Webman\Bootstrap;

class CliLogListenerBootstrap implements Bootstrap
{
    public static function start($worker): void
    {
        $is_console = !$worker;
        if (!$is_console) {
            return;
        }

        global $argv;
        $executeCommand = 'php '. implode(' ', $argv);
        Log::channel('cli')->info($executeCommand);
    }
}
