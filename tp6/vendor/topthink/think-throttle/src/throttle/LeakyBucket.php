<?php


namespace think\middleware\throttle;

/**
 * 漏桶算法
 * Class LeakyBucket
 * @package think\middleware\throttle
 */
class LeakyBucket extends ThrottleAbstract
{

    public function allowRequest(string $key, float $micronow, int $max_requests, int $duration, $cache)
    {
        if ($max_requests <= 0) return false;

        $last_time = $cache->get($key, 0);      // 最近一次请求
        $rate = (float) $duration / $max_requests;       // 平均 n 秒一个请求
        if ($micronow - $last_time < $rate) {
            $this->cur_requests = 1;
            $this->wait_seconds = ceil($rate);
            return false;
        }

        $cache->set($key, $micronow, $duration);
        return true;
    }
}