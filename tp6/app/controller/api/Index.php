<?php
declare (strict_types=1);

namespace app\controller\api;

use app\controller\api\Base;
use think\annotation\route\Group;
use think\annotation\Route;
/**
 * 非用户身份类接口
 * Class Index
 * @package app\controller\api
 * @author  2066362155@qq.com
 * @Group("api/index")
 */
class Index extends Base
{
    /**
     * @Route("index", method="GET")
     */
    public function index()
    {
        echo '123123';
    }
}
