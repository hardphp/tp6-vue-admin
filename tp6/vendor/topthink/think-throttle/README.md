### 安装
```
composer require topthink/think-throttle
```
安装后会自动为项目生成 `conf/throttle.php` 配置文件，默认配置不会限制访问频率。

### 开启
组件以中间件的方式进行工作，因此它的开启与其他中间件一样，例如在全局中间件中使用 `app/middleware.php` :
```
<?php
return [
    \think\middleware\Throttle::class,
];
```
### 配置说明
在 `config/throttle.php` 配置选项:
```
<?php
// 中间件配置
return [
    // 缓存的键，true 表示使用来源ip
    'key' => true,
    // 设置访问频率，此处指的是允许每分钟请求10次。默认值 null 表示不限制
    'visit_rate' => '10/m',
    // 访问受限时返回的http状态码
    'visit_fail_code' => 429,
    // 访问受限时访问的文本信息
    'visit_fail_text' => '访问频率受到限制，请稍等__WAIT__秒再试', 
];
```

当配置项满足以下条件任何一个时，不会限制访问频率：
1. `key` 值为 `false` 或 `null`；
2. `visit_rate` 值为 `null`。

其中 `key` 用来设置缓存键的；而 `visit_rate` 用来设置访问频率，单位可以是秒，分，时，天，例如：`1/s`, `10/m`, `98/h`, `100/d` , 也可以是 `100/600` （600 秒内最多 100 次请求）。

### 灵活定制
示例一：针对用户个体做限制， `key` 的值可以设为函数，该函数返回新的缓存键值，例如：
```
'key' => function($throttle, $request) {
    $user_id = $request->session->get('user_id');
    return $user_id ;
},
```
实例二：也可以在回调函数里针对不同控制器和方法定制生成key，中间件会进行转换:
```
'key' => function($throttle, $request) {
    return '__CONTROLLER__/__ACTION__/__IP__';
},
```
或者直接设置:
```
'key' => '__CONTROLLER__/__ACTION__/__IP__',
```
PS：此示例需要本中间件在路由中间件后启用，这样预设的替换功能才会生效。

示例三：允许在闭包内修改本次访问频率或临时更换限流策略：
```
'key' => function($throttle, $request) {
    $throttle->setRate('5/m');                      // 设置频率
    $throttle->setDriverClass(CounterSlider::class);// 设置限流策略
    return true;
},
```

## 更新日志
版本 1.1.x 的配置形式完全兼容版本 1.0.x 内容，可以无缝升级。

### 1.1.x 更新
- 添加漏桶限流算法, 令牌桶算法, 计数固定窗口, 滑动窗口共四种限流策略；
- 公共数据改为静态属性，节省内存分配；
- 重构中间件接口，便于扩展更多的限流算法；
- 默认策略使用计数固定窗口的策略；
- 时间取毫秒，某些限流算法需要；
- 只使用一个缓存键完成计数固定窗口，减少缓存读取；
- 开放更多 `set*` 方法，支持链式操作；
- 禁止访问时，改用抛出 `HttpResponseException`；
