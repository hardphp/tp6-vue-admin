<?php
declare (strict_types=1);

namespace app\controller\admin;

use app\BaseController;
use app\service\AdminService;
use think\annotation\route\Group;
use think\annotation\Route;

/**
 * 登陆
 * Class Login
 * @package app\controller\admin
 * @author  2066362155@qq.com
 * @Group("admin/login")
 */
class Login extends BaseController
{
    /**
     * 登录
     * @Route("index", method="POST")
     */
    public function index()
    {
        //接收数据
        $data = [
            'username' => input('username', '', 'trim'),
            'password' => input('password', '', 'trim'),
            'code'     => input('code', '', 'trim'),
            'key'      => input('key', '', 'trim')
        ];
        if (empty($data['username'])) {
            return json_error(12007);
        }
        if (empty($data['password'])) {
            return json_error(12008);
        }

        if (empty($data['code'])) {
            return json_error(11109);
        }
        if (empty($data['key'])) {
            return json_error(10004);
        }
        //验证码验证
        if (!captcha_check($data['key'], $data['code'])) {
            return json_error(11110);
        }

        // 登录验证并获取包含访问令牌的用户
        $result = AdminService::login($data['username'], $data['password']);
        return json_ok($result, 11108);
    }


}
