<?php
declare (strict_types=1);

namespace app\listener\admin;

use app\service\AdminService;
use app\service\LoginLogService;

/**
 * 用户登录事件
 * Class AdminLogin
 * @package app\listener\admin
 * @author 2066362155@qq.com
 */
class AdminLogin
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event)
    {
        list($user, $group, $time) = $event;
        AdminService::save(['login_time' => $time], $user['id']);
        LoginLogService::save([
            'uid'        => $user['id'],
            'username'   => $user['username'],
            'roles'      => $group['title'],
            'login_time' => $time,
            'login_ip'   => request()->ip()
        ]);
    }
}
