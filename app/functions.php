<?php
/**
 * Here is your custom functions.
 */

if (!function_exists('get_trace_id')) {
    /**
     * 获取追踪ID
     * @return string
     */
    function get_trace_id(): string
    {
        $traceId = \Webman\App::request()->traceId;
        if (isset($traceId)) {
            return $traceId;
        }

        $traceId = str_replace('-', '', uuid_v4());
        \Webman\App::request()->traceId = $traceId;
        return $traceId;
    }
}

if (!function_exists('get_cli_trace_id')) {
    /**
     * 获取CLI追踪ID
     * @return string
     */
    function get_cli_trace_id(): string
    {
        if (!isset($GLOBALS['CLI_TRACE_ID'])) {
            $GLOBALS['CLI_TRACE_ID'] = str_replace('-', '', uuid_v4());
        }
        return $GLOBALS['CLI_TRACE_ID'];
    }
}

if (!function_exists('reset_cli_trace_id')) {
    /**
     * 重置CLI追踪ID
     * @return void
     */
    function reset_cli_trace_id(): void
    {
        unset($GLOBALS['CLI_TRACE_ID']);
    }
}

if (!function_exists('uuid_v4')) {
    /**
     * 高性能UUID生成（平衡速度与随机性）
     * @param bool $secure 是否使用密码学安全随机数（默认false）
     */
    function uuid_v4(bool $secure = false): string
    {
        // 密码学安全版本（速度稍慢）
        if ($secure) {
            $data = random_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // UUID version 4
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // RFC 4122 variant
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        // 高性能版本（非安全随机）
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000, // 强制第13字符为 '4'
            mt_rand(0, 0x3fff) | 0x8000, // 强制第17字符为 '8'/'9'/'a'/'b'
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}
