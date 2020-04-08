<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: hardphp <hardphp@163.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace hardphp\snowflake;

class Service extends \think\Service
{
    //向tinkphp中注册snowflake服务
    public function register()
    {
        $this->app->bind('snowflake', Snowflake::class);
    }
}
