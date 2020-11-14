<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: hardphp <hardphp@163.com>
// +----------------------------------------------------------------------

use hardphp\captcha\facade\Captcha;
use think\facade\Route;
use think\Response;

/**
 * @param string $config
 * @return 
 */
function captcha($config = null)
{
    return Captcha::create($config);
}


/**
 * @param string $key
 * @param string $value
 * @return bool
 */
function captcha_check($key,$value)
{
    return Captcha::check($key,$value);
}
