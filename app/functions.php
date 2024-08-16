<?php
/**
 * Here is your custom functions.
 */

/**
 * 获取追踪ID
 * @return string
 */
if (!function_exists('get_trace_id')) {
    function get_trace_id(): string
    {
        $traceId = \Webman\App::request()->traceId;
        if (isset($traceId)) {
            return $traceId;
        }

        $traceId = md5(time() . mt_rand(100000, 999999));
        \Webman\App::request()->traceId = $traceId;
        return $traceId;
    }
}

/**
 * 获取CLI追踪ID
 * @return string
 */
if (!function_exists('get_cli_trace_id')) {
    function get_cli_trace_id(): string
    {
        if (!isset($GLOBALS['CLI_TRACE_ID'])) {
            $GLOBALS['CLI_TRACE_ID'] = md5(time() . mt_rand(100000, 999999));
        }
        return $GLOBALS['CLI_TRACE_ID'];
    }
}

/**
 * 重置CLI追踪ID
 * @return void
 */
if (!function_exists('reset_cli_trace_id')) {
    function reset_cli_trace_id(): void
    {
        unset($GLOBALS['CLI_TRACE_ID']);
    }
}
