<?php

namespace app\bootstrap;

use Illuminate\Support\Str;
use support\Db;
use support\Log;
use Webman\Bootstrap;

class DbLogListenerBootstrap implements Bootstrap
{
    public static function start($worker): void
    {
        Db::listen(function ($query) {
            $sql = $query->sql;
            $time = $query->time;
            if ($sql == 'select 1') {
                return;
            }

            $bindings = [];
            if ($query->bindings) {
                foreach ($query->bindings as $v) {
                    if (is_numeric($v)) {
                        $bindings[] = $v;
                    } else {
                        $bindings[] = '"' . strval($v) . '"';
                    }
                }
            }
            $execute = Str::replaceArray('?', $bindings, $sql);
            Log::channel('sql')->info('[' . $time . 'ms] ' . $execute);

            if (env('APP_ENV', 'prod') == 'local') {
                echo '[' . $time . 'ms] ' . $execute . "\n";
            }
        });
    }
}
