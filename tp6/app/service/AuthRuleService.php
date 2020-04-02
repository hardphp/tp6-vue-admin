<?php
declare (strict_types=1);
namespace app\service;

use app\repository\AuthGroupRepository;
use app\traits\ServiceTrait;

/**
 * 权限组
 * Class AuthRuleService
 * @package app\service
 * @author  2066362155@qq.com
 */
class AuthRuleService
{
    //仓库，带命名空间
    public static $repository = 'app\repository\AuthRuleRepository';

    use ServiceTrait;

    /**
     * 获取权限组权限
     * @param $groupId 分组id
     * @return array
     */
    public static function getAuthByGroupId($groupId)
    {
        //获取分组信息
        $group = AuthGroupRepository::getInfoById($groupId);
        if ($group['status'] != 1 || empty($group['rules'])) {
            return [];
        }
        //分组角色
        $ruleIds = explode(',', $group['rules']);
        $rules   = self::$repository::getListsAll([['id', 'in', $ruleIds],['status','=',1]], ['id' => 'asc']);
        return $rules;
    }

}
