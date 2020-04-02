<?php
declare (strict_types=1);

namespace app\listener\user;

use app\service\UserService;
/**
 * 用户登录事件
 * Class UserLogin
 * @package app\listener\user
 * @author 2066362155@qq.com
 */
class UserLogin
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event)
    {
        list($uid, $time) = $event;
        UserService::save(['login_time' => $time], $uid);
    }
}
