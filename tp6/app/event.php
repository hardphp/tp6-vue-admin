<?php
// 事件定义文件
return [
    'bind' => [
    ],

    'listen' => [
        'AppInit'    => [],
        'HttpRun'    => [],
        'HttpEnd'    => [],
        'LogLevel'   => [],
        'LogWrite'   => [],
        'UserLogin'  => ['app\listener\user\UserLogin'],
        'AdminLogin' => ['app\listener\admin\AdminLogin'],
    ],

    'subscribe' => [
        'app\subscribe\User'
    ],
];
