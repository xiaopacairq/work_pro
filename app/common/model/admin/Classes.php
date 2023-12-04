<?php

namespace app\common\model\admin;

use think\Model;
use think\facade\Db;


class Classes extends Model
{
    protected $table = 'classes';

    /**
     * 查找管理员的个人信息
     */
    public function getAdmin($id)
    {
        return Db::table('admin')->where('id', $id)->find();
    }

    /**
     * 更新管理员信息
     */
    public function setAdmin($id, $data)
    {
        Db::table('admin')->where('id', $id)->update($data);
    }

    /**
     * 查找班级的信息
     */
    public function getClasses()
    {
        return $this->select()->toArray();
    }

    /**
     * 根据where
     * 查找班级信息
     */
    public function findClasses($class_id)
    {
        return $this->where('class_id', $class_id)->findOrEmpty();
    }

    /**
     * 添加班级信息
     */
    public function insertClasses($data)
    {
        $this->insert($data);
    }

    /**
     * 修改班级信息
     */
    public function updateClasses($class_id, $data)
    {
        $this->where('class_id', $class_id)->update($data);
    }

    /**
     * 删除班级的信息数据表信息
     */
    public function delData($class_id)
    {
        Db::table('classes')->where('class_id', $class_id)->delete();
        Db::table('score')->where('class_id', $class_id)->delete();
        Db::table('is_work')->where('class_id', $class_id)->delete();
        Db::table('works')->where('class_id', $class_id)->delete();
        Db::table('work')->where('class_id', $class_id)->delete();
        Db::table('stu')->where('class_id', $class_id)->delete();
    }
}