<?php

namespace app\controller;

use app\util\RespUtil;
use support\Request;

class IndexController
{
    public function index(Request $request)
    {
        return RespUtil::sucJson();
    }
}
