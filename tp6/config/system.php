<?php
// +----------------------------------------------------------------------
// | 系统设置
// +----------------------------------------------------------------------

use think\facade\Env;

return [

    'jwt_secret_key' => '88&%99@*^66*11@***###',
    // jwt算法 ，可配置的值取决于使用的jwt包支持哪些算法
    'jwt_algorithm'  => 'HS256',
    //加密盐值
    'pass_salt'             => '88&%99@*^66*11',
    // 是否开启app接口签名认证
    'app_sign_auth_on'      => true,
    // 控制器免签白名单
    'app_sign_white_url'    => ['admin/upload/upimg', 'api/upload/upimg'],
    // app接口加密安全key
    'app_sign_key'          => '#l_vle_ll_e%+$^@0608)[@***###',
    //用户登录有效期
    'user_login_time'       => 60 * 60 * 24 * 7,

    //小程序配置
    'wechat_mini'           => [

        'app_id'        => 'wxd8a482ca4ad05dde',
        'secret'        => '0e35ece9c9922148b78eefc783f7138a',

        // 下面为可选项
        // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
        'response_type' => 'array',

        'log' => [
            'level' => 'debug',
            'file'  => __DIR__ . '/../runtime/wechat.log',
        ]
    ],
    //短信配置
    'sms'                   => [
        'info' => [
            'send_url'    => 'http://api.mix2.zthysms.com/v2/sendSms',
            'send_tp_url' => 'http://api.mix2.zthysms.com/v2/sendSmsTp',
            'username'    => 'kamenghy',
            'password'    => 'S2Y3lN5e',
        ],
        //模板
        'con'  => '【咖盟】您的验证码为：@，有效时间10分钟'
    ],
];
