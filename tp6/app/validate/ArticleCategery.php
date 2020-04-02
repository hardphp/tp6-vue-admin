<?php
declare (strict_types=1);

namespace app\validate;

use think\Validate;

/**
 * 文章分类
 * Class ArticleCategery
 * @package app\validate
 * @author  2066362155@qq.com
 * @date 2019-11-27
 */
class ArticleCategery extends Validate
{
    //验证规则
    protected $rule = [
        'name'      => ['require'],
        'column_id' => ['require'],
    ];

    //提示信息
    protected $message = [
        'name'      => '名称必填',
        'column_id' => '栏目必选',
    ];
    //验证场景
    protected $scene = [
        'save' => ['name', 'column_id'],
    ];

}
