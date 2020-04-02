<?php
declare (strict_types=1);

namespace app\service;

use app\traits\ServiceTrait;
use think\facade\Config;
use think\helper\Str;

/**
 * 手机短信服务
 * Class SmsService
 * @package app\service
 * @author  2066362155@qq.com
 */
class SmsService
{
    //仓库，带命名空间
    public static $repository = 'app\repository\SmsRepository';

    use ServiceTrait;

    /**
     * 手机短信验证
     * @param $phone
     * @param $code
     * @param int $type 1=注册，2=登录，3=找回密码
     * @throws \think\Exception
     */
    public static function checkCode($phone, $code, $type = 1)
    {
        $info = self::$repository::getInfoByPhone($phone, $type);
        if (empty($info) || $info['deadline'] < time()) {
            throw new \app\MyException(10311);
        } elseif ($info['code'] !== $code) {
            throw new \app\MyException(10312);
        }
        return true;
    }

    /**
     * 发送验证码
     * @param $phone
     * @param int $type 1=注册，2=登录，3=找回密码
     */
    public static function sendSmsCode($phone, $type = 1)
    {
        //1.生成验证码
        $info = self::$repository::getInfoByPhone($phone, $type);
        $code = Str::random(6, 1);
        if (empty($info)) {
            $data['code']     = $code;
            $data['phone']    = $phone;
            $data['type']     = $type;
            $data['status']   = 0;
            $data['ip']       = request()->ip();
            $data['deadline'] = time() + 10 * 60;

            $res = self::save($data);
            if (!$res) {
                throw new \app\MyException(10012);
            }
        } elseif ($info['deadline'] < time()) {
            $data['deadline'] = time() + 10 * 60;
            $data['code']     = $code;
            $data['ip']       = request()->ip();

            $res = self::save($data, $info['id']);
            if (!$res) {
                throw new \app\MyException(10012);
            }
        } elseif ($info['addTime'] < time() - 60) {
            //60s内不允许第二次发送
            return true;
        }

        //2.发送验证码
        $sms = Config::get("app.sms");
        if (empty($sms) || !isset($sms['info']['username']) || !isset($sms['info']['password']) || !isset($sms['info']['send_url'])) {
            throw new \app\MyException(10003);
        }

        $content = str_replace('@', $code, $sms['con']);

        //地址
        $url              = $sms['info']['send_url'];
        $info             = [];
        $info['mobile']   = $phone;
        $info['content']  = $content;
        $info['tKey']     = time();
        $info['username'] = $sms['info']['username'];
        $info['password'] = md5(md5($sms['info']['password']) . $info['tKey']);


        $res = curl_post($url, $info);
        $res = json_decode($res, true);

        if ($res['code'] == 200) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 发送短信
     * @param $data
     */
    public static function sendSms($data)
    {
        if (isset($data['phone']) && isset($data['type'])) {
            return self::sendSmsCode($data['phone'], $data['type']);
        }

    }

}
