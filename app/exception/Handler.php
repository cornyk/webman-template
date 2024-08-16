<?php

namespace app\exception;

use app\common\RespDef;
use PDOException;
use Respect\Validation\Exceptions\ValidationException;
use support\Db;
use support\exception\Handler as WebmanExceptionHandler;
use support\Log;
use Throwable;
use Webman\Http\Request;
use Webman\Http\Response;

class Handler extends WebmanExceptionHandler
{
    public $dontReport = [];

    public function report(Throwable $exception): void
    {
        // 如果异常抛出时在事务中，需要手动回滚事务
        if (Db::transactionLevel() > 0) {
            Db::rollBack();
        }

        if ($this->shouldntReport($exception)) {
            return;
        }

        if ($exception instanceof PDOException) {
            Log::channel('sql_error')->error($exception);
        } else {
            Log::channel('error')->error($exception);
        }
    }

    public function render(Request $request, Throwable $exception): Response
    {
        $code = $exception->getCode();

        // 入参错误
        if ($exception instanceof ValidationException) {
            $code = RespDef::CODE_MISSING_PARAMS;
        }

        if (config('app.debug', false)) {
            return json(['code' => $code ?: 500, 'message' => (string)$exception, 'data' => null]);
        }
        return json(['code' => $code ?: 500, 'message' => 'System Error.', 'data' => null]);
    }
}
