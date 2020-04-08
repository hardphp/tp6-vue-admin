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
declare(strict_types=1);

namespace hardphp\filesystem\driver;

use League\Flysystem\AdapterInterface;
use think\filesystem\Driver;
use hardphp\filesystem\adapter\OssAdapter;

class Aliyun extends Driver
{
    protected function createAdapter(): AdapterInterface
    {
        $aliyun = new OssAdapter([
            'accessId'     => $this->config['accessId'],
            'accessSecret' => $this->config['accessSecret'],
            'bucket'       => $this->config['bucket'],
            'endpoint'     => $this->config['endpoint'],
        ]);

        return $aliyun;
    }

    public function geturl($path)
    {
        return isset($this->config['url']) && $this->config['url'] ? $this->config['url'] . DIRECTORY_SEPARATOR . $path
            : $path;
    }
}
