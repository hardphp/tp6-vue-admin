<?php
declare (strict_types=1);

namespace app\controller\admin;

use app\controller\admin\Base;
use app\service\AuthRuleService;
use app\traits\ControllerTrait;
use think\annotation\route\Group;
use think\annotation\Route;

/**
 * 规则管理
 * Class Rules
 * @package app\controller\admin
 * @author  2066362155@qq.com
 * @Group("admin/rules")
 */
class Rules extends Base
{
    //服务，带命名空间
    public static $service = 'app\service\AuthRuleService';
    //验证器名称
    public static $validateName = 'AuthRule';
    //保存验证场景
    public static $validateScene = '';
    //状态变更允许字段,格式 字段名：允许值
    public static $enableField = ['status' => [0, 1]];

    use ControllerTrait;

    //查询条件前置处理
    public function beforeGetLists()
    {
        //搜索参数
        $title  = input('title', '', 'trim');
        $status = input('status', -1, 'int');

        $where = true;
        if ($title) {
            $where .= " and title like '%" . $title . "%' ";
        }
        if ($status != -1) {
            $where .= " and status = " . $status;
        }

        return [$where, []];
    }

    //保存前置处理
    public function beforeSave($id)
    {
        //接收数据
        $data = [
            'pid'         => input('pid', 0, 'int'),
            'title'       => input('title', '', 'trim'),
            'name'        => input('name', '', 'trim'),
            'icon'        => input('icon', '', 'trim'),
            'status'      => input('status', 0, 'int'),
            'path'        => input('path', '', 'trim'),
            'component'   => input('component', '', 'trim'),
            'redirect'    => input('redirect', '', 'trim'),
            'hidden'      => input('hidden', 0, 'int'),
            'no_cache'    => input('no_cache', 1, 'int'),
            'always_show' => input('always_show', 1, 'int')
        ];

        if ($id && $id == $data['pid']) {
            return json_error(10009);
        }
        return $data;
    }
}
