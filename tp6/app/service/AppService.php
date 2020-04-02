<?php
declare (strict_types=1);
namespace app\service;

use app\traits\ServiceTrait;

/**
 * 应用
 * Class AppService
 * @package app\service
 * @author  2066362155@qq.com
 */
class AppService
{
    //仓库，带命名空间
    public static $repository = 'app\repository\AppRepository';

    use ServiceTrait;

}
