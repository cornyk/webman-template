<?php

namespace app\common;

class RespDef
{
    const CODE_SUCCESS = 0;

    // 系统相关
    const CODE_NO_API = -1001;
    const CODE_SYSTEM_ERROR = -1002;
    const CODE_MISSING_PARAMS = -1003;
    const CODE_UNAUTHORIZED = -1004;
    const CODE_DB_ERROR = -1005;

    const MSG_SUCCESS = 'ok';

    // 系统相关
    const MSG_NO_API = 'API not exist.';
    const MSG_SYSTEM_ERROR = 'System error.';
    const MSG_MISSING_PARAMS = 'Missing parameters.';
    const MSG_UNAUTHORIZED = 'Login invalid.';
    const MSG_DB_ERROR = 'System error.';
}
