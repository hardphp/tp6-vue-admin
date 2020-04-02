<?php
declare (strict_types=1);
namespace app\repository;

use app\traits\RepositoryTrait;

/**
 * 图片hash
 * Class ImageHashRepository
 * @package app\repository
 * @author  2066362155@qq.com
 */
class ImageHashRepository
{

    //模型，带命名空间
    public static $model = 'app\model\ImageHash';
    //模型主键
    public static $pk = 'id';
    //name字段名称
    public static $name = 'hash';

    use RepositoryTrait;

}
