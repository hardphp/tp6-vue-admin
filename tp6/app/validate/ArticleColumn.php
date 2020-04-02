<?php
declare (strict_types=1);

namespace app\validate;

use think\Validate;

/**
 * 文章栏目
 * Class ArticleColumn
 * @package app\validate
 * @author  2066362155@qq.com
 * @date 2019-11-27
 */
class ArticleColumn extends Validate
{
    //验证规则
    protected $rule = [
        'name'    => ['require'],
    ];

    //提示信息
    protected $message = [
        'name'    => '名称必填',
    ];

    //验证场景
    protected $scene = [
        'save' => ['name'],
    ];
}
