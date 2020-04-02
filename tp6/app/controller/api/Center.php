<?php
declare (strict_types=1);
namespace app\controller\api;

use app\controller\api\Base;

/**
 * 会员中心
 * Class Center
 * @package app\controller\api
 * @author  2066362155@qq.com
 */
class Center extends Base
{
    //用户信息
    protected $user = [];
    // 初始化
    protected function initialize()
    {
        parent::initialize();
        $this->user = $this->request->sys_user;
    }

}
