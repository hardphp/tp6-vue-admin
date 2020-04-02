<?php
declare (strict_types=1);

namespace app\controller\admin;

use app\controller\admin\Base;
use app\service\AuthGroupService;
use app\service\AuthRuleService;
use app\traits\ControllerTrait;
use think\annotation\route\Middleware;
use think\annotation\route\Group;
use think\annotation\Route;
use app\middleware\CheckAdmin;
use app\util\TreeUtil;

/**
 * 管理员管理
 * Class Admin
 * @package app\controller\admin
 * @author  2066362155@qq.com
 * @Group("admin/admin")
 * @Middleware({CheckAdmin::class})
 */
class Admin extends Base
{
    //服务，带命名空间
    public static $service = 'app\service\AdminService';
    //验证器名称
    public static $validateName = 'Admin';
    //保存验证场景
    public static $validateScene = 'save';
    //状态变更允许字段,格式 字段名：允许值
    public static $enableField = ['is_enabled' => [0, 1]];

    use ControllerTrait;

    /**
     * 获取登录用户信息
     * @Route("getuser", method="POST")
     */
    public function getuser()
    {
        $user['username']    = $this->user->username;
        $user['email']       = $this->user->email;
        $user['realname']    = $this->user->realname;
        $user['phone']       = $this->user->phone;
        $user['img']         = $this->user->img;
        $user['group_id']    = $this->user->group_id;
        $user['create_time'] = $this->user->create_time;
        $user['login_time']  = $this->user->login_time ? date('Y-m-d H:i:s', $this->user->login_time) : '';
        $group               = AuthGroupService::getInfoById($this->user->group_id);
        $user['group']       = $group['title'];

        $rules = AuthRuleService::getAuthByGroupId($this->user->group_id);
        $rules = TreeUtil::listToTreeMulti($rules, 0, 'id', 'pid', 'children');

        $routers = [];

        foreach ($rules as $v) {
            $temp = $this->getdata($v);
            foreach ($v['children'] as $vo) {
                $temp['children'][] = $this->getdata($vo);
            }
            $routers[] = $temp;
        }
        $user['access'] = $routers;

        return json_ok($user);
    }

    protected function getdata($data)
    {
        $temp              = [];
        $temp['path']      = $data['path'];
        $temp['component'] = $data['component'];
        $temp['name']      = $data['name'];
        if ($data['hidden'] > -1) {
            $temp['hidden'] = (boolean)$data['hidden'];
        }
        if ($data['always_show'] > -1) {
            $temp['alwaysShow'] = (boolean)$data['always_show'];
        }
        if ($data['redirect']) {
            $temp['redirect'] = $data['redirect'];
        }
        $temp['meta']['title'] = $data['title'];
        $temp['meta']['icon']  = $data['icon'];
        if ($data['no_cache'] > -1) {
            $temp['meta']['noCache'] = (boolean)$data['no_cache'];
        }

        return $temp;
    }

    //查询条件前置处理
    public function beforeIndex()
    {
        //搜索参数
        $is_enabled = input('is_enabled', -1, 'intval');
        $username   = input('username', '', 'trim');
        $phone      = input('phone', '', 'trim');
        $realname   = input('realname', '', 'trim');
        $start_time = input('start_time', '', 'strtotime');
        $end_time   = input('end_time', '', 'strtotime');

        $where = true;
        if ($username) {
            $where .= " and username like '%" . $username . "%' ";
        }
        if ($phone) {
            $where .= " and phone like '%" . $phone . "%' ";
        }
        if ($realname) {
            $where .= " and realname like '%" . $realname . "%' ";
        }
        if ($start_time) {
            $where .= " and login_time >= " . $start_time . " ";
        }
        if ($end_time) {
            $where .= " and login_time <= " . $end_time . " ";
        }
        if ($is_enabled != -1) {
            $where .= " and is_enabled = " . $is_enabled;
        }

        return [$where, []];
    }


    //保存前置处理
    public function beforeSave($id)
    {
        //接收数据
        $data = [
            'id'         => $id,
            'group_id'   => input('group_id', '', 'trim'),
            'username'   => input('username', '', 'trim'),
            'realname'   => input('realname', '', 'trim'),
            'img'        => input('img', '', 'trim'),
            'phone'      => input('phone', '', 'trim'),
            'email'      => input('email', '', 'trim'),
            'password'   => input('password', '', 'trim'),
            'is_enabled' => input('is_enabled', 0, 'int'),
        ];

        if ($id == 0) {
            $data['reg_ip'] = request()->ip();
        }
        if ($data['password']) {
            $data['password'] = encrypt_pass($data['password']);
        } else {
            unset($data['password']);
        }

        return $data;
    }
}
