<?php
declare (strict_types=1);

namespace app\validate;

use think\Validate;

/**
 * 文章
 * Class Article
 * @package app\validate
 * @author  2066362155@qq.com
 * @date 2019-11-27
 */
class Article extends Validate
{
    //验证规则
    protected $rule = [
        'title'     => ['require'],
        'cate_id'   => ['require'],
        'column_id' => ['require'],
        'content'   => ['require'],
    ];

    //提示信息
    protected $message = [
        'title'     => '标题必填',
        'cate_id'   => '分类必选',
        'column_id' => '栏目必选',
        'content'   => '详情必填',
    ];
    //验证场景
    protected $scene = [
        'save'   => ['title', 'cate_id', 'column_id', 'content'],
    ];

}
