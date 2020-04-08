# think-annotation for ThinkPHP6

## 安装

> composer require topthink/think-annotation

## 配置

> 配置文件位于 `config/annotation.php`

## 使用方法

### 路由注解

~~~php
<?php

namespace app\controller;

use think\annotation\Inject;
use think\annotation\Route;
use think\annotation\route\Group;
use think\annotation\route\Middleware;
use think\annotation\route\Resource;
use think\Cache;
use think\middleware\SessionInit;

/**
 * Class IndexController
 * @package app\controller
 * @Group("bb")
 * @Resource("aa")
 * @Middleware({SessionInit::class})
 */
class IndexController
{

    /**
     * @Inject()
     * @var Cache
     */
    protected $cache;

    public function index()
    {
        //...
    }

    /**
     * @Route("xx")
     */
    public function xx()
    {
        //...
    }

}

~~~

### 模型注解

~~~php
<?php

namespace app\model;

use think\Model;
use think\annotation\model\relation\HasMany;

/**
 * @HasMany("articles", model=Article::class, foreignKey="user_id")
 */
class User extends Model
{

    //...
}
~~~

IDE Support
-----------

Some IDEs already provide support for annotations:

- Eclipse via the Symfony2 Plugin <http://symfony.dubture.com/>
- PHPStorm via the PHP Annotations Plugin <http://plugins.jetbrains.com/plugin/7320> or the Symfony2 Plugin <http://plugins.jetbrains.com/plugin/7219>

