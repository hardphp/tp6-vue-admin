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

namespace hardphp\captcha;

class CaptchaController
{
    public function index(Captcha $captcha, $config = null)
    {
		$result['status'] = 1;
		$result['data']   = $captcha->create($config);
		$result['msg']    = '无错误';
		$result['code']   = 10000;
		return json($result);
    }
}
