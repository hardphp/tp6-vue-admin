<?php


namespace think\middleware\throttle;

/**
 * 令牌桶算法
 * Class TokenBucket
 * @package think\middleware\throttle
 */
class TokenBucket extends ThrottleAbstract
{
    public function allowRequest(string $key, float $micronow, int $max_requests, int $duration, $cache)
    {
        if ($max_requests <= 0 || $duration <= 0) return false;

        $assist_key = $key . 'store_num';              // 辅助缓存
        $rate = (float) $max_requests / $duration;     // 平均 n 秒生成一个 token

        $last_time = $cache->get($key, null);
        $store_num = $cache->get($assist_key, null);

        if ($last_time === null || $store_num === null) {      // 首次访问
            $cache->set($key, $micronow, $duration);
            $cache->set($assist_key, $max_requests - 1, $duration);
            return true;
        }

        $create_num = floor(($micronow - $last_time) * $rate);              // 推算生成的 token 数
        $token_left = (int) min($max_requests, $store_num + $create_num);  //当前剩余 tokens 数量

        if ($token_left < 1) {
            $tmp = (int) ceil($duration / $max_requests);
            $this->wait_seconds = $tmp - ($micronow - $last_time) % $tmp;
            return false;
        }
        $this->cur_requests = $max_requests - $token_left;
        $cache->set($key, $micronow, $duration);
        $cache->set($assist_key, $token_left - 1, $duration);
        return true;
    }
}