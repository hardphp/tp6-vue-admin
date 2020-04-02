<?php
declare (strict_types=1);
namespace app\validate;

use think\Validate;

/**
 * 用户
 * Class User
 * @package app\validate
 * @author  2066362155@qq.com
 * @date 2019-11-27
 */
class User extends Validate
{
    //验证规则
    protected $rule = [
        'realname'   => ['require'],
        'gender'     => ['require'],
        'phone'      => ['regex' => '/1[3458]{1}\d{9}$/'],
        'mobile'     => ['regex' => '/1[3458]{1}\d{9}$/'],
        'email'      => ['email'],
        'card_front' => ['require'],
        'card_back'  => ['require'],
        'company'    => ['require'],
        'telphone'   => ['require'],
        'license'    => ['require']
    ];

    //提示信息
    protected $message = [
        'realname'     => '请输入姓名',
        'gender'       => '请选择性别',
        'phone.regex'  => '手机格式错误',
        'mobile.regex' => '手机格式错误',
        'email'        => '请输入正确的邮箱',
        'card_front'   => '请上传身份证正面',
        'card_back'    => '请上传身份证反面',
        'company'      => '请输入公司名称',
        'telphone'     => '请输入办公电话',
        'license'      => '请上传营业执照',
    ];

    //验证场景
    protected $scene = [
        'info'          => ['realname', 'gender', 'card_front', 'card_back'],
        'company'       => ['company', 'telphone', 'license'],
    ];


}
