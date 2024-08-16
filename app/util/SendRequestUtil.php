<?php

namespace app\util;

use GuzzleHttp\Client;
use support\Log;

class SendRequestUtil
{
    /**
     * 发出请求
     * @param string $url
     * @param string $method
     * @param array $data
     * @param float $timeout
     * @param int $retry
     * @return string|null
     */
    public static function send(string $url, string $method = 'GET', array $data = [], float $timeout = 5.0, int $retry = 3): ?string
    {
        $requestClient = new Client([
            'timeout' => $timeout,
            'verify' => !(env('APP_ENV', 'prod') == "local"),
        ]);
        $requestData = $data;
        if (isset($data['body']) && is_array($data['body'])) {
            $data['body'] = json_encode($data['body']);
        }
        $sendDing = true;
        $responseData = null;
        for ($i = 0; $i < $retry; $i++) {
            $logString = "URL: {$url}, METHOD: {$method}, DATA: " . json_encode($requestData, JSON_UNESCAPED_UNICODE) . ", TIMEOUT: {$timeout}, RETRY: " . ($i + 1);

            try {
                $response = $requestClient->request($method, $url, $data);
            } catch (\Throwable $e) {
                $errorInfo = $e->getMessage();
                if ($sendDing) {
//                    AlarmUtil::sendAlarm(implode(PHP_EOL, [
//                        'FAILED SEND REQUEST:' . $logString,
//                        'ERROR INFO:' . $errorInfo,
//                    ]));
                    $sendDing = false;
                }

                Log::channel('send_request_error')->error("FAILED SEND REQUEST: {$logString}, ERROR INFO: {$errorInfo}");
                continue;
            }

            $responseStatusCode = $response->getStatusCode();
            if ($responseStatusCode == 200 || $responseStatusCode == 201 || $responseStatusCode == 202) {
                $responseData = $response->getBody()->getContents();
                Log::channel('send_request')->info("SUCCESS SEND REQUEST: {$logString}, STATUS_CODE: 200, RESPONSE_DATA: {$responseData}");
                break;
            } else {
                Log::channel('send_request_error')->error("FAILED SEND REQUEST: {$logString}, STATUS_CODE: {$responseStatusCode}");
            }
        }
        return $responseData;
    }
}
