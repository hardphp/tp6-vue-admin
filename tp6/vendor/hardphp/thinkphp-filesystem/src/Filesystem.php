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

namespace hardphp\filesystem;

use think\Filesystem as ThinkFilesystem;

class Filesystem extends ThinkFilesystem
{
    //驱动命名空间
    protected $namespace = '\\hardphp\\filesystem\\driver\\';
}
