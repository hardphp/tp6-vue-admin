<?php
declare (strict_types=1);
namespace app\repository;

use app\traits\RepositoryTrait;

/**
 * 文章
 * Class ArticleRepository
 * @package app\repository
 * @author  2066362155@qq.com
 */
class ArticleRepository
{
    //模型，带命名空间
    public static $model = 'app\model\Article';
    //模型主键
    public static $pk = 'id';
    //name字段名称
    public static $name = 'cate_id';

    use RepositoryTrait;

}
