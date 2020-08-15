<?php
declare (strict_types=1);
namespace app\controller;

use app\BaseController;

/**
 * 管理端基类
 * Class AdminController
 * @package app\controller
 * @author  2066362155@qq.com
 */
class AdminController extends BaseController
{
    //用户信息
    protected $user = [];

    // 初始化
    protected function initialize()
    {
        $this->user = $this->request->sys_user;
        //权限验证,1=超级管理员，放行 TODO
        if ($this->user->group_id !== 1) {

        }
    }

}
