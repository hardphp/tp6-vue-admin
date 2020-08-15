<?php

declare (strict_types = 1);

namespace think\middleware;

use Closure;
use think\Cache;
use think\Config;
use think\Container;
use think\exception\HttpResponseException;
use think\middleware\throttle\CounterFixed;
use think\middleware\throttle\CounterSlider;
use think\Request;
use think\Response;

/**
 * 访问频率限制中间件
 * Class Throttle
 * @package think\middleware
 */
class Throttle
{
    /**
     * 默认配置参数
     * @var array
     */
    public static $default_config = [
        'prefix' => 'throttle_',                    // 缓存键前缀，防止键与其他应用冲突
        'key'    => true,                           // 节流规则 true为自动规则
        'visit_rate' => null,                       // 节流频率 null 表示不限制 eg: 10/m  20/h  300/d
        'visit_fail_code' => 429,                   // 访问受限时返回的http状态码
        'visit_fail_text' => 'Too Many Requests',   // 访问受限时访问的文本信息
        'driver_name' => CounterFixed::class,       // 限流算法驱动
    ];

    public static $duration = [
        's' => 1,
        'm' => 60,
        'h' => 3600,
        'd' => 86400,
    ];

    /**
     * 缓存对象
     * @var Cache
     */
    protected $cache;

    /**
     * 配置参数
     * @var array
     */
    protected $config = [];

    protected $key = null;          // 解析后的标识
    protected $wait_seconds = 0;    // 下次合法请求还有多少秒
    protected $now = 0;             // 当前时间戳
    protected $max_requests = 0;    // 规定时间内允许的最大请求次数
    protected $expire = 0;          // 规定时间
    protected $remaining = 0;       // 规定时间内还能请求的次数
    protected $driver_class = null;

    public function __construct(Cache $cache, Config $config)
    {
        $this->cache  = $cache;
        $this->config = array_merge(static::$default_config, $config->get('throttle', []));
    }

    /**
     * 请求是否允许
     * @param $request
     * @return bool
     */
    protected function allowRequest($request)
    {
        $key = $this->getCacheKey($request);
        if (null === $key) {
            return true;
        }
        list($max_requests, $duration) = $this->parseRate($this->config['visit_rate']);

        $micronow = microtime(true);
        $now = (int) $micronow;

        $this->driver_class = Container::getInstance()->invokeClass($this->config['driver_name']);
        $allow = $this->driver_class->allowRequest($key, $micronow, $max_requests, $duration, $this->cache);

        if ($allow) {
            // 允许访问
            $this->now = $now;
            $this->expire = $duration;
            $this->max_requests = $max_requests;
            $this->remaining = $max_requests - $this->driver_class->getCurRequests();
            return true;
        }

        $this->wait_seconds = $this->driver_class->getWaitSeconds();
        return false;
    }

    /**
     * 处理限制访问
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        $allow = $this->allowRequest($request);
        if (!$allow) {
            // 访问受限
            throw $this->buildLimitException($this->wait_seconds);
        }
        $response = $next($request);
        if (200 == $response->getCode()) {
            // 将速率限制 headers 添加到响应中
            $response->header([
                'X-Rate-Limit-Limit' => $this->max_requests,
                'X-Rate-Limit-Remaining' => $this->remaining < 0 ? 0 : $this->remaining,
                'X-Rate-Limit-Reset' => $this->now + $this->expire,
            ]);
        }
        return $response;
    }

    /**
     * 生成缓存的 key
     * @param Request $request
     * @return null|string
     */
    protected function getCacheKey($request)
    {
        $key = $this->config['key'];

        if ($key instanceof \Closure) {
            $key = Container::getInstance()->invokeFunction($key, [$this, $request]);
        }

        if ($key === null || $key === false || $this->config['visit_rate'] === null) {
            // 关闭当前限制
            return;
        }

        if ($key === true) {
            $key = $request->ip();
        } elseif (false !== strpos($key, '__')) {
            $key = str_replace(['__CONTROLLER__', '__ACTION__', '__IP__'], [$request->controller(), $request->action(), $request->ip()], $key);
        }

        return md5($this->config['prefix'] . $key . $this->config['driver_name']);
    }

    /**
     * 解析频率配置项
     * @param $rate
     * @return array
     */
    protected function parseRate($rate)
    {
        list($num, $period) = explode("/", $rate);
        $max_requests = (int) $num;
        $duration = static::$duration[$period] ?? (int) $period;
        return [$max_requests, $duration];
    }

    /**
     * 设置速率
     * @param $rate string '10/m'  '20/300'
     * @return $this
     */
    public function setRate($rate)
    {
        $this->config['visit_rate'] = $rate;
        return $this;
    }

    /**
     * 设置缓存驱动
     * @param $cache
     * @return $this
     */
    public function setCache($cache)
    {
        $this->cache = $cache;
        return $this;
    }

    /**
     * 设置限流算法类
     * @param $class_name
     */
    public function setDriverClass($class_name) {
        $this->config['driver_name'] = $class_name;
        return $this;
    }

    /**
     * 构建 Response Exception
     * @param $content
     * @param $wait_seconds
     * @return HttpResponseException
     */
    public function buildLimitException($wait_seconds) {
        $content = str_replace('__WAIT__', $wait_seconds, $this->config['visit_fail_text']);
        $response = Response::create($content)->code($this->config['visit_fail_code']);
        $response->header(['Retry-After' => $wait_seconds]);
        return new HttpResponseException($response);
    }

}
