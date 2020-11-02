<?php

use think\facade\Env;

return [
    // 默认磁盘
    'default' => Env::get('filesystem.driver', 'local'),
    // 磁盘列表
    'disks'   => [
        'local'  => [
            'type' => 'local',
            'root' => app()->getRuntimePath() . 'storage',
        ],
        'public' => [
            // 磁盘类型
            'type'       => 'local',
            // 磁盘路径
            'root'       => app()->getRootPath() . 'public/storage',
            // 磁盘路径对应的外部URL路径
            'url'        => '/storage',
            // 可见性
            'visibility' => 'public',
        ],
        // 更多的磁盘配置信息
        'aliyun' => [
            'type'         => 'aliyun',
            'accessId'     => 'SKFy1jm8nlnf8zbk',
            'accessSecret' => 'WJFd4g1avjjUyoaDUxWt22n8rfaCnh',
            'bucket'       => 'hardphp',
            'endpoint'     => 'oss-cn-beijing.aliyuncs.com',
            'url'          => 'https://hardphp.oss-cn-beijing.aliyuncs.com',//不要斜杠结尾，此处为URL地址域名。
            'process'      => [],//图片处理器
        ]

    ],
];
