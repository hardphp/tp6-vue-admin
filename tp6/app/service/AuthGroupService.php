<?php
declare (strict_types=1);
namespace app\service;

use app\traits\ServiceTrait;

/**
 * 权限组
 * Class AuthGroupService
 * @package app\service
 * @author  2066362155@qq.com
 */
class AuthGroupService
{
    //仓库，带命名空间
    public static $repository = 'app\repository\AuthGroupRepository';

    use ServiceTrait;

}
