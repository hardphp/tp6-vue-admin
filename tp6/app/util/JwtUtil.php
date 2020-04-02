<?php
declare (strict_types=1);

namespace app\util;

use Firebase\JWT\JWT;
use think\facade\Config;
use think\facade\Log;

/**
 * jwt 加解密
 * Class JwtUtil
 * @package app\util
 * @author  2066362155@qq.com
 */
class JwtUtil
{
    /** 加密
     * @param $payload object|array $payload 代表JWT's payload的对象或数组
     * @return mixed 已编码的json web token字符串
     * @throws \think\Exception 读取配置失败时
     */
    public static function encode($payload)
    {
        // 读取配置
        $secretKey = Config::get('system.jwt_secret_key');
        $algorithm = Config::get('system.jwt_algorithm');
        if (!$secretKey || !$algorithm) {
            throw new \app\MyException(10003);
        }
        // 使用Firebase JWT解码并返回
        return JWT::encode($payload, $secretKey, $algorithm);
    }

    /**
     * @param $jwt 已编码的json web token字符串
     * @return bool object|boolean 签名认证通过时，代表JWT's payload的对象；解码或签名认证失败时，false；
     * @throws \think\Exception 读取配置失败时
     */
    public static function decode($jwt)
    {
        // 读取配置
        $secretKey = Config::get('system.jwt_secret_key');
        $algorithm = Config::get('system.jwt_algorithm');
        if (!$secretKey || !$algorithm) {
            throw new \app\MyException(10003);
        }

        // 使用Firebase JWT解码
        try {
            $decode = JWT::decode($jwt, $secretKey, array($algorithm));
            return $decode;
        } catch (\app\MyException $e) {
            return false;
        }
    }

}
