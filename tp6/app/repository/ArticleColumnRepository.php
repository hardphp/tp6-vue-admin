<?php
declare (strict_types=1);

namespace app\repository;

use app\traits\RepositoryTrait;

/**
 * 文章栏目
 * Class ArticleColumnRepository
 * @package app\repository
 * @author  2066362155@qq.com
 */
class ArticleColumnRepository
{
    //模型，带命名空间
    public static $model = 'app\model\ArticleColumn';
    //模型主键
    public static $pk = 'id';
    //name字段名称
    public static $name = 'pid';

    use RepositoryTrait;

}
