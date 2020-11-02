<?php
declare (strict_types=1);

namespace app\controller\admin;

use app\controller\admin\Base;
use app\traits\ControllerTrait;
use think\annotation\route\Group;
use think\annotation\Route;
/**
 * 文章栏目管理
 * Class ArticleColumn
 * @package app\controller\admin
 * @author  2066362155@qq.com
 * @Group("admin/articlecolumn")
 */
class ArticleColumn extends Base
{
    //服务，带命名空间
    public static $service = 'app\service\ArticleColumnService';
    //验证器名称
    public static $validateName = 'ArticleColumn';
    //保存验证场景
    public static $validateScene = 'save';
    //状态变更允许字段,格式 字段名：允许值
    public static $enableField = ['status' => [0, 1]];

    use ControllerTrait;

    //查询条件前置处理
    public function beforeIndex()
    {
        //搜索参数
        $status = input('status', -1, 'intval');
        $name   = input('name', '', 'trim');

        $where = true;
        if ($name) {
            $where .= " and name like '%" . $name . "%' ";
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
            'name'      => input('name', '', 'trim'),
            'seo_dec'   => input('seo_dec', '', 'trim'),
            'seo_title' => input('seo_title', '', 'trim'),
            'pid'       => input('pid', 0, 'int'),
            'sorts'     => input('sorts', 0, 'int'),
            'status'    => input('status', 0, 'int'),
        ];

        return $data;
    }
}
