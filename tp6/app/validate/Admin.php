<?php
declare (strict_types=1);

namespace app\validate;

use think\Validate;

/**
 * 管理员
 * Class Admin
 * @package app\validate
 * @author  2066362155@qq.com
 * @date 2019-11-27
 */
class Admin extends Validate
{
    //验证规则
    protected $rule = [
        'username' => ['require', 'max' => '25', 'alphaDash', 'unique:admin'],
        'password' => ['require'],
        'group_id' => ['require', 'gt' => '0'],
        'phone'    => ['regex' => '/1[3458]{1}\d{9}$/'],
        'email'    => ['email'],
        'verify'   => ['require', 'captcha']
    ];

    //提示信息
    protected $message = [
        'username.require'   => '账号必须',
        'username.max'       => '账号最多不能超过25个字符',
        'username.alphaDash' => '账号必须是字母,数字，下滑线',
        'username.unique'    => '账号已存在',
        'password'           => '密码必须',
        'group_id'           => '请选择角色',
        'phone.regex'        => '手机格式错误',
        'email'              => '邮箱格式错误',
        'verify.require'     => '验证码必须',
        'verify.captcha'     => '验证码错误'
    ];

    //验证场景
    protected $scene = [
        'save'   => ['username', 'group_id', 'phone', 'email'],
        'modify' => ['phone', 'email'],
    ];


}
