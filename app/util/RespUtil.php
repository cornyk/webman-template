<?php

namespace app\util;

use app\common\RespDef;
use support\Response;

class RespUtil
{
    public static function sucJson($data = null): Response
    {
        return self::json(RespDef::CODE_SUCCESS, RespDef::MSG_SUCCESS, $data);
    }

    /**
     * @param int $code
     * @param string $msg
     * @param object|array|null $data
     * @param int $httpStatus
     * @return Response
     */
    public static function json(int $code, string $msg, object|array|null $data = null, int $httpStatus = 200): Response
    {
        $return = [
            'code' => $code,
            'message' => $msg,
            'data' => $data == null ? null : (object) $data,
        ];

        return new Response($httpStatus, ['Content-Type' => 'application/json'], json_encode($return, JSON_UNESCAPED_UNICODE));
    }
}
