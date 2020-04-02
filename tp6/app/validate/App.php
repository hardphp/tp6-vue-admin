<?php
declare (strict_types=1);
namespace app\validate;

use think\Validate;

/**
 * 应用
 * Class App
 * @package app\validate
 * @author  2066362155@qq.com
 */
class App extends Validate
{
    //验证规则
    protected $rule = [
        'appid'     => ['require', 'length' => '18', 'alphaNum'],
        'app_salt' => ['require', 'length' => '32', 'alphaNum'],
    ];

    //提示信息
    protected $message = [
        'appid.require'      => 'appid必须',
        'appid.length'       => 'appid不正确',
        'appid.alphaNum'     => 'appid不正确',
        'app_salt.require'  => 'app_salt必须',
        'app_salt.length'   => 'app_salt不正确',
        'app_salt.alphaNum' => 'app_salt不正确',
    ];

    //验证场景
    protected $scene = [
        'login' => ['appid', 'app_salt'],
    ];


}
