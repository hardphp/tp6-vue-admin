<?php
declare (strict_types=1);

namespace app\service;

use app\traits\ServiceTrait;
use app\util\JwtUtil;

/**
 * 用户
 * Class UserService
 * @package app\service
 * @author  2066362155@qq.com
 */
class UserService
{
    //仓库，带命名空间
    public static $repository = 'app\repository\UserRepository';

    use ServiceTrait;


    /**
     * 获取用户身份token
     * @param $user 用户信息
     */
    public static function getToken($uid,$time)
    {
        //登录事件
        event('UserLogin', [$uid, $time]);

        // 令牌生成
        $payload['uid']        = $uid;
        $payload['login_time'] = $time;
        $user_token            = think_encrypt(JwtUtil::encode($payload));
        // 返回
        return $user_token;
    }

    /**
     * 通过手机号获取信息
     * @param $phone
     */
    public static function getInfoByPhone($phone, $field = [])
    {
        return self::$repository::getInfoByPhone($phone, $field);
    }

}
