<?php
declare (strict_types=1);

namespace app\repository;

use app\traits\RepositoryTrait;

/**
 * 用户
 * Class UserRepository
 * @package app\repository
 * @author  2066362155@qq.com
 */
class UserRepository
{
    //模型，带命名空间
    public static $model = 'app\model\User';
    //模型主键
    public static $pk = 'id';
    //name字段名称
    public static $name = 'openid';

    use RepositoryTrait;

    /**
     * 通过手机号获取信息
     * @param $phone
     */
    public static function getInfoByPhone($phone, $field = [])
    {
        return self::$model::where(['phone' => $phone])->field($field ?: self::$model::$showField)->find();
    }

}
