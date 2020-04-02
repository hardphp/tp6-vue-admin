<?php
declare (strict_types=1);
namespace app\repository;

use app\traits\RepositoryTrait;

/**
 * 短信
 * Class SmsRepository
 * @package app\repository
 * @author  2066362155@qq.com
 */
class SmsRepository
{
    //模型，带命名空间
    public static $model = 'app\model\Sms';
    //模型主键
    public static $pk = 'id';
    //name字段名称
    public static $name = 'phone';

    use RepositoryTrait;

    /**
     * 获取未使用验证码
     * @param $phone
     * @param $type
     * @return mixed
     */
    public static function getInfoByPhone($phone, $type)
    {
        return self::$model::where(['phone' => $phone, 'type' => $type, 'status' => 0])->find();
    }

}
