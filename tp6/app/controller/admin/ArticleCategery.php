<?php
declare (strict_types=1);

namespace app\controller\admin;

use app\controller\admin\Base;
use app\traits\ControllerTrait;
use think\annotation\route\Group;
use think\annotation\Route;

/**
 * 文章分类管理
 * Class ArticleCategery
 * @package app\controller\admin
 * @author  2066362155@qq.com
 * @Group("admin/articlecategery")
 */
class ArticleCategery extends Base
{
    //服务，带命名空间
    public static $service = 'app\service\ArticleCategeryService';
    //验证器名称
    public static $validateName = 'ArticleCategery';
    //保存验证场景
    public static $validateScene = 'save';
    //状态变更允许字段,格式 字段名：允许值
    public static $enableField = ['status' => [0, 1]];

    use ControllerTrait;

    //查询条件前置处理
    public function beforeIndex()
    {
        //搜索参数
        $status    = input('status', -1, 'intval');
        $column_id = input('column_id', -1, 'intval');
        $name      = input('name', '', 'trim');

        $where = true;
        if ($name) {
            $where .= " and name like '%" . $name . "%' ";
        }
        if ($status != -1) {
            $where .= " and status = " . $status;
        }
        if ($column_id != -1) {
            $where .= " and column_id = " . $column_id;
        }

        return [$where, []];
    }


    //保存前置处理
    public function beforeSave($id)
    {
        //接收数据
        $data = [
            'name'      => input('name', '', 'trim'),
            'content'   => input('content', '', 'trim'),
            'column_id' => input('column_id', 0, 'int'),
            'sorts'     => input('sorts', 0, 'int'),
            'status'    => input('status', 0, 'int'),
        ];

        return $data;
    }
}
