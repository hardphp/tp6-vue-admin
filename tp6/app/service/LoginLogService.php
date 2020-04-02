<?php
declare (strict_types=1);

namespace app\service;

use app\traits\ServiceTrait;

/**
 * 管理员登录日志
 * Class LoginLogService
 * @package app\service
* @author  2066362155@qq.com
*/
class LoginLogService
{
    //仓库，带命名空间
    public static $repository = 'app\repository\LoginLogRepository';

    use ServiceTrait;

}
