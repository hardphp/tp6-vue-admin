<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: hardphp <hardphp@163.com>
// +----------------------------------------------------------------------

return [
    'default' => 'local',
    'meta'    => [
        'local' => [
            'type'             => 'local',
            'millisecondBits'  => 41,//时间戳毫秒二进制位数，也就是说 41 位 可以表示 2^41 - 1 个毫秒的值，转化成单位年则是 (2^41 - 1) / (1000 * 60 * 60 * 24 * 365) 约为 69 年
            'dataCenterIdBits' => 5,//数据中心 ID二进制位数
            'workerIdBits'     => 5,//工作机器 ID二进制位数
            'sequenceBits'     => 12,//序列号二进制位数，来表示同一机器同一时间截毫秒内产生的 4095 个 ID 序号
            'dataCenterId'     => 1,//设置数据中心 ID
            'workerId'         => 1,//设置工作机器 ID
            'beginTimestamp'   => 1577712936000,//开始时间，小于当前时间
        ],
        'redis' => [
            'type'             => 'redis',
            'millisecondBits'  => 41,//时间戳毫秒二进制位数，也就是说 41 位 可以表示 2^41 - 1 个毫秒的值，转化成单位年则是 (2^41 - 1) / (1000 * 60 * 60 * 24 * 365) 约为 69 年
            'dataCenterIdBits' => 5,//数据中心 ID二进制位数
            'workerIdBits'     => 5,//工作机器 ID二进制位数
            'sequenceBits'     => 12,//序列号二进制位数，来表示同一机器同一时间截毫秒内产生的 4095 个 ID 序号
            'dataCenterId'     => 1,//设置数据中心 ID
            'workerId'         => 1,//设置工作机器 ID
            'beginTimestamp'   => 1577712936000,//开始时间，小于当前时间
            'redisKey'         => 'hardphp:snowflake:workerId',
            'host'             => '127.0.0.1',
            'port'             => 6379,
            'password'         => '',
            'timeout'          => 0,
            'persistent'       => false,
        ]
    ]
];
