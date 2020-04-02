<?php
declare (strict_types=1);

namespace app\traits;

/**
 * 数据仓库公共方法
 * Trait RepositoryTrait
 * @package app\traits
 */
trait RepositoryTrait
{

    /**
     * 通过ID获取信息
     * @param $id
     * @param $field 获取字段
     * @param $where 附加条件
     * @return mixed
     */
    public static function getInfoById($id, $field = [], $where = true)
    {
        return self::$model::where([self::$pk => $id])->where($where)->field($field ?: self::$model::$showField)->find();
    }

    /**
     * 通过name获取信息
     * @param $name
     * @param $field 获取字段
     * @param $where 附加条件
     * @return mixed
     */
    public static function getInfoByName($name, $field = [], $where = true)
    {
        return self::$model::where([self::$name => $name])->where($where)->field($field ?: self::$model::$showField)->find();
    }

    /**
     * 获取列表,分頁
     * @param bool $where 查询条件
     * @param array $myorder 排序
     * @param int $page 页码
     * @param int $psize 分页大小
     * @param array $field 获取字段
     * @return mixed
     */
    public static function getLists($where, $myorder, $page = 1, $psize = 20, $field = [])
    {
        return self::$model::where($where)->order($myorder)->page($page, $psize)->field($field ?: self::$model::$showField)->select();
    }

    /**
     * 获取全部列表
     * @param bool $where 查询条件
     * @param array $myorder 排序
     * @param array $field 获取字段
     * @return mixed
     */
    public static function getListsAll($where, $myorder, $field = [])
    {
        return self::$model::where($where)->order($myorder)->field($field ?: self::$model::$showField)->select();
    }

    /**
     * 查询数量
     * @param bool $where 查询条件
     * @return mixed
     */
    public static function getTotal($where)
    {
        return self::$model::where($where)->count();
    }

    /**
     * 新增
     * @param $data
     */
    public static function add($data)
    {
        return self::$model::create($data);
    }

    /**
     * 修改
     * @param $id
     * @param $data
     */
    public static function edit($id, $data)
    {
        return self::$model::update($data, [self::$pk => $id]);
    }

    /**
     * 删除
     * @param int/array $id
     * @return int
     */
    public static function del($id)
    {
        return self::$model::destroy($id);
    }

}