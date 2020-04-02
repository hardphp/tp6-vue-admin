<?php
declare (strict_types=1);
namespace app\service;

use app\traits\ServiceTrait;

/**
 * 文章分类
 * Class ArticleCategeryService
 * @package app\service
 * @author  2066362155@qq.com
 */
class ArticleCategeryService
{
    //仓库，带命名空间
    public static $repository = 'app\repository\ArticleCategeryRepository';

    use ServiceTrait;

}
