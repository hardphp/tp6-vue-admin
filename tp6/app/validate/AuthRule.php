<?php
declare (strict_types=1);
namespace app\validate;

use think\Validate;

/**
 * 规则
 * Class AuthRule
 * @package app\validate
 * @author  2066362155@qq.com
 * @date 2019-11-27
 */
class AuthRule extends Validate
{
    //验证规则
    protected $rule = [
        'title'     => ['require'],
        'name'      => ['require'],
        'icon'      => ['require'],
        'path'      => ['require'],
        'component' => ['require'],
    ];

    //提示信息
    protected $message = [
        'title'     => '名称必填',
        'name'      => '标识必填',
        'icon'      => '图标必填',
        'path'      => '路径必填',
        'component' => '组件必填',
    ];


}
