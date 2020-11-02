<?php
declare (strict_types=1);

namespace app\controller\admin;

use app\controller\admin\Base;
use app\traits\ControllerTrait;
use think\annotation\route\Group;
use think\annotation\Route;

/**
 * 文章管理
 * Class Article
 * @package app\controller\admin
 * @author  2066362155@qq.com
 * @Group("admin/article")
 */
class Article extends Base
{
    //服务，带命名空间
    public static $service = 'app\service\ArticleService';
    //验证器名称
    public static $validateName = 'Article';
    //保存验证场景
    public static $validateScene = 'save';
    //状态变更允许字段,格式 字段名：允许值
    public static $enableField = ['status' => [0, 1]];

    use ControllerTrait;

    //查询条件前置处理
    public function beforeIndex()
    {
        //搜索参数
        $status     = input('status', -1, 'intval');
        $cate_id    = input('cate_id', 0, 'intval');
        $column_id  = input('column_id', 0, 'intval');
        $title      = input('title', '', 'trim');
        $start_time = input('start_time', '', 'strtotime');
        $end_time   = input('end_time', '', 'strtotime');

        $where = true;
        if ($title) {
            $where .= " and title like '%" . $title . "%' ";
        }
        if ($start_time) {
            $where .= " and create_time >= " . $start_time . " ";
        }
        if ($end_time) {
            $where .= " and create_time <= " . $end_time . " ";
        }
        if ($status != -1) {
            $where .= " and status = " . $status;
        }
        if ($cate_id != 0) {
            $where .= " and cate_id = " . $cate_id;
        }
        if ($column_id != 0) {
            $where .= " and column_id = " . $column_id;
        }

        return [$where, []];
    }


    //保存前置处理
    public function beforeSave($id)
    {
        //接收数据
        $data = [
            'title'     => input('title', '', 'trim'),
            'content'   => input('content', '', 'trim'),
            'img'       => input('img', '', 'trim'),
            'cate_id'   => input('cate_id', 0, 'int'),
            'column_id' => input('column_id', 0, 'int'),
            'sorts'     => input('sorts', 0, 'int'),
            'status'    => input('status', 0, 'int'),
        ];

        return $data;
    }
}
