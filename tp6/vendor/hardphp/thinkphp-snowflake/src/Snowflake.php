<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: hardphp <hardphp@163.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace hardphp\snowflake;

use InvalidArgumentException;
use think\Factory;
use think\helper\Str;

/**
 * Class snowflake
 */
class Snowflake extends Factory
{
    protected $namespace = '\\hardphp\\snowflake\\generator\\meta\\';

    /**
     * Get the snowflake configuration.
     *
     * @param string $name
     * @return array
     */
    protected function getConfig($name)
    {
        return $this->app->config->get("snowflake.meta.{$name}", ['type' => 'local']);
    }

    protected function createDriver($name)
    {
        $driver = $this->getConfig($name)['type'];

        $class = false !== strpos($driver, '\\') ? $driver : $this->namespace . Str::studly($driver);

        /** @var $driver */
        if (class_exists($class)) {
            $driver = $this->app->invokeClass($class, [$this->getConfig($driver)]);

            return $driver;
        }

        throw new InvalidArgumentException("Driver [$driver] not supported.");
    }

    /**
     * 默认驱动
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app->config->get('snowflake.default');
    }
}
