<?php
declare (strict_types=1);

namespace app\model;

use think\Model;
use app\traits\ModelTrait;

/**
 * 管理员登陆日志
 * Class LoginLog
 * @package app\model
 * @author  2066362155@qq.com
 */
class LoginLog extends Model
{
    //时间字段显示格式
    protected $dateFormat = 'Y-m-d H:i:s';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    //据输出显示的属性
    public static $showField = ['id', 'username', 'uid', 'login_ip', 'login_time', 'roles', 'create_time', 'update_time'];

    //查询类型转换, 与Model 中的type类型转化功能相同，只是新增字符串类型
    protected $selectType = [
        'id'  => 'string',
        'uid' => 'string',
    ];

    use ModelTrait;
}



