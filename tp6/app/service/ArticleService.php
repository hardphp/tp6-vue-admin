<?php
declare (strict_types=1);
namespace app\service;

use app\traits\ServiceTrait;

/**
 * 文章
 * Class ArticleService
 * @package app\service
 * @author  2066362155@qq.com
 */
class ArticleService
{
    //仓库，带命名空间
    public static $repository = 'app\repository\ArticleRepository';

    use ServiceTrait;

}
