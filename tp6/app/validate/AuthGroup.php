<?php
declare (strict_types=1);
namespace app\validate;

use think\Validate;

/**
 * 分组
 * Class AuthGroup
 * @package app\validate
 * @author  2066362155@qq.com
 * @date 2019-11-27
 */
class AuthGroup extends Validate
{
    //验证规则
    protected $rule = [
        'title' => ['require'],
        'rules' => ['require'],
    ];

    //提示信息
    protected $message = [
        'title' => '名称必填',
        'rules' => '选择权限',
    ];


}
