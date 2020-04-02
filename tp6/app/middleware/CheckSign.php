<?php
declare (strict_types=1);

namespace app\middleware;

use think\facade\Config;
use app\service\AppService;
use think\facade\Log;

/**
 * 签名验证
 * Class CheckSign
 * @package app\middleware
 * @author  2066362155@qq.com
 */
class CheckSign
{
    public function handle($request, \Closure $next)
    {
        $appid = $request->header('x-access-appid');
        if (empty($appid)) {
            throw new \app\MyException(11001);
        }
        // 实时数据
        $app = AppService::getInfoByName($appid);
        //认证：状态
        if (empty($app)) {
            throw new \app\MyException(11001);
        }

        if (empty($app) || $app ['is_enabled'] != true) {
            throw new \app\MyException(11002);
        }

        //免签白名单
        if ($request->pathinfo() && Config::get("system.app_sign_white_url") && in_array($request->pathinfo(), Config::get("system.app_sign_white_url"))) {
            return $next($request);
        }

        // 接口签名认证
        if (Config::get("system.app_sign_auth_on") === true) {
            // app端生成的签名
            $signature = $request->param("signature");
            $param     = $request->param();
            unset($param['signature']);
            if (empty($signature)) {
                throw new \app\MyException(11003);
            }
            //数组排序
            ksort($param);
            $str        = http_build_query($param);
            $signature1 = md5(sha1($str) . $app['app_salt']);
            Log::write('signature='.$signature1);
            if ($signature != $signature1) {
                throw new \app\MyException(11004);
            }
        }

        return $next($request);

    }
}
