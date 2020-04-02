<?php
declare (strict_types=1);

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;
use app\traits\ModelTrait;

/**
 * 管理员
 * Class Admin
 * @package app\model
 * @author  2066362155@qq.com
 */
class Admin extends Model
{
    use SoftDelete;
    //时间字段显示格式
    protected $dateFormat = 'Y-m-d H:i:s';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    //软删除时间
    protected $deleteTime = 'delete_time';
    //软删除字段的默认值
    protected $defaultSoftDelete = 0;
    //只读字段，不允许被更改
    protected $readonly = [];

    //数据输出隐藏的属性
    protected $hidden = ['delete_time', 'password'];

    //据输出显示的属性
    public static $showField = ['id', 'username', 'password', 'email', 'realname', 'phone', 'img', 'reg_ip', 'login_time', 'login_ip', 'is_enabled', 'group_id', 'create_time'];

    //查询类型转换, 与Model 中的type类型转化功能相同，只是新增字符串类型
    protected $selectType = [
        'id'       => 'string',
        'group_id' => 'string',
    ];

    use ModelTrait;
}



