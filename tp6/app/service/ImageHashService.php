<?php
declare (strict_types=1);

namespace app\service;

use app\traits\ServiceTrait;

/**
 *图片hash
 * Class ImageHashService
 * @package app\service
 * @author  2066362155@qq.com
 */
class ImageHashService
{
    //仓库，带命名空间
    public static $repository = 'app\repository\ImageHashRepository';

    use ServiceTrait;

}
