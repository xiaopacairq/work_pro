<?php

namespace app\common\model;

use think\Model;


class Classes extends Model
{
    protected $table = 'classes';

    /**
     * 查找班级信息
     */
    public function findClasses($class_id)
    {
        return $this->where('class_id', $class_id)->findOrEmpty();
    }

    /**
     * 查找班级列表
     */
    public function getClassesList()
    {
        return $this->select()->toArray();
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
     * 删除布置作业文件数据
     */
    public function delClasses($class_id)
    {
        $this->where('class_id', $class_id)->delete();
    }
}