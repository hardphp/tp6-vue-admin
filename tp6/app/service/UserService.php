<?php
declare (strict_types=1);

namespace app\service;

use app\traits\ServiceTrait;
use app\util\JwtUtil;
use think\facade\Config;

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

    /**
     * 用户身份验证
     */
    public static function checkUser($userToken)
    {
        // JWT用户令牌认证，令牌内容获取
        if (empty($userToken)) {
            throw new \app\MyException(11101);
        }
        $userToken = think_decrypt($userToken);
        $payload   = JwtUtil::decode($userToken);
        if ($payload === false || empty($payload->uid) || empty($payload->login_time)) {
            throw new \app\MyException(11101);
        }
        //用户登录有效期
        $userLoginTime = Config::get('system.user_login_time');
        if ($payload->login_time < time() - $userLoginTime) {
            throw new \app\MyException(11102);
        }
        // 实时用户数据
        $user = self::$repository::getInfoById($payload->uid);

        //用户是否存在
        if (empty($user)) {
            throw new \app\MyException(11104);
        }

        //是否多设备登录
        if (!empty($user['login_time']) && $user['login_time'] != $payload->login_time) {
            throw new \app\MyException(11103);
        }
        //认证：状态
        if ($user['is_enabled'] != true) {
            throw new \app\MyException(11106);
        }

        return array('user' => $user);
    }

}
