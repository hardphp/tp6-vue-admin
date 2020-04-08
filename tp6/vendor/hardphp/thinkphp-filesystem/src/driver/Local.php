<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace hardphp\filesystem\driver;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Adapter\Local as LocalAdapter;
use think\filesystem\Driver;

class Local extends Driver
{
    /**
     * 配置参数
     * @var array
     */
    protected $config = [
        'root' => '',
    ];

    protected function createAdapter(): AdapterInterface
    {
        $permissions = $this->config['permissions'] ?? [];

        $links = ($this->config['links'] ?? null) === 'skip'
        ? LocalAdapter::SKIP_LINKS
        : LocalAdapter::DISALLOW_LINKS;

        return new LocalAdapter(
            $this->config['root'], LOCK_EX, $links, $permissions
        );
    }

    public function geturl($path)
    {
        return isset($this->config['url']) && $this->config['url'] ? $this->config['url'] . DIRECTORY_SEPARATOR . $path
            : $path;
    }
}
