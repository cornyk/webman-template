<?php

namespace app\middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class TraceIdMiddleware implements MiddlewareInterface
{

    public function process(Request $request, callable $handler): Response
    {
        $response = $handler($request);
        $response->header('Trace-Id', get_trace_id());
        return $response;
    }
}
