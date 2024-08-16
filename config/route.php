<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use app\common\RespDef;
use app\controller\IndexController;
use app\util\RespUtil;
use support\Request;
use Webman\Route;

/**
 * 路由配置
 */
Route::get('/', [IndexController::class, 'index']);


/**
 * 健康检测URL
 */
Route::any('/ping', function ($request) {
    return RespUtil::sucJson();
});

/**
 * 自定义404
 */
Route::fallback(function (Request $request) {
    if ($request->method() == 'OPTIONS') {
        return (new \app\middleware\CorsMiddleware())->addCorsHeader($request, response(''));
    }
    return RespUtil::json(RespDef::CODE_NO_API, RespDef::MSG_NO_API, null, 404);
});

/**
 * 关闭默认路由
 */
Route::disableDefaultRoute();
