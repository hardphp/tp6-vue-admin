<?php
declare (strict_types=1);

namespace app\controller\api;

use app\controller\api\Center;
use think\annotation\route\Group;
use think\annotation\Route;
/**
 * 个人中心
 * Class User
 * @package app\controller\api
 * @author  2066362155@qq.com
 * @Group("api/user")
 */
class User extends Center
{
    /**
     * @Route("index", method="GET")
     */
    public function index()
    {
        echo 'user';
        var_dump($this->user->id);
    }
}
