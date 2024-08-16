<?php

namespace app\middleware;

use support\Log;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class RequestLogMiddleware implements MiddlewareInterface
{

    private array $notRecordBodyUrl = [];

    public function process(Request $request, callable $handler): Response
    {
        $response = $handler($request);

        $requestIp = $request->getRealIp();
        $url = $request->path();
        $statusCode = $response->getStatusCode();
        $method = $request->method();
        $bodyParams = http_build_query($request->all());
        $headers = json_encode($request->header());

        if (in_array($url, $this->notRecordBodyUrl)) {
            $rawBody = 'skip-record';
        } else {
            $rawBody = preg_replace('/\s(?=\s)/', '', preg_replace("/(\r\n|\n|\r|\t)/i", ' ', $request->rawBody()));
        }

        $responseBody = $response->rawBody();

        $log = "[{$requestIp}]URL: '{$url}', STATUS_CODE: '{$statusCode}', METHOD: '{$method}', BODY_PARAMS: '{$bodyParams}', RAW_BODY: '{$rawBody}', HEADERS: '{$headers}'; RESPONSE: '{$responseBody}'";
        Log::channel('access')->info($log);

        return $response;
    }
}
