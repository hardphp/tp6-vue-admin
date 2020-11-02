<?php
declare (strict_types=1);

namespace app\controller\admin;

use app\controller\admin\Base;
use app\service\AuthGroupService;
use app\traits\ControllerTrait;
use think\annotation\route\Group;
use think\annotation\Route;

/**
 * 分组管理
 * Class Group
 * @package app\controller\admin
 * @author  2066362155@qq.com
 * @Group("admin/groups")
 */
class Groups extends Base
{
    //服务，带命名空间
    public static $service = 'app\service\AuthGroupService';
    //验证器名称
    public static $validateName = 'AuthGroup';
    //保存验证场景
    public static $validateScene = '';
    //状态变更允许字段,格式 字段名：允许值
    public static $enableField = ['status' => [0, 1]];

    use ControllerTrait;

    //查询条件前置处理
    public function beforeIndex()
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

    //查询条件前置处理
    public function beforeGetLists()
    {
        return [['status'=>1], []];
    }

    //保存前置处理
    public function beforeSave($id)
    {
        //接收数据
        $data = [
            'title'  => input('title', '', 'trim'),
            'status' => input('status', 0, 'int'),
            'rules'  => input('rules/a', '')
        ];
        if ($data['rules']) {
            $data['rules'] = implode(',', $data['rules']);
        }
        return $data;
    }

}
