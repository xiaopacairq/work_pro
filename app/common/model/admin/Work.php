<?php

namespace app\common\model\admin;

use think\Model;
use think\facade\Db;

class Work extends Model
{
    protected $table = 'work';

    /**
     * 获取作业表的信息
     */
    public function getWorkList($class_id)
    {
        $res = $this->where('class_id', $class_id)->select()->toArray();
        return $res;
    }

    /**
     * 判断作业id是否已存在
     */
    public function findWork($class_id, $work_id)
    {
        $res = $this->where(['class_id' => $class_id, 'work_id' => $work_id])->findOrEmpty();
        return $res;
    }

    /**
     * 判断作业中间表is_work，学生确定作业的状态
     */
    public function findStuWorkStatusByIsWork($stu_no, $work_id)
    {
        $res = Db::table('is_work')->where(['stu_no' => $stu_no, 'work_id' => $work_id])->find();
        return $res;
    }

    /**
     * 添加作业
     */
    public function addWork($data)
    {
        $this->insert($data);
    }

    /**
     * 修改作业
     */
    public function editWork($class_id, $work_id, $data)
    {
        $this->where(['class_id' => $class_id, 'work_id' => $work_id])->update($data);
    }

    /**删除作业 */
    public function delWork($id, $class_id, $work_id)
    {
        Db::table('work')->where('id', $id)->delete();
        Db::table('is_work')->where(['class_id' => $class_id, 'work_id' => $work_id])->delete();
        Db::table('works')->where(['class_id' => $class_id, 'work_id' => $work_id])->delete();
        Db::table('score')->where(['class_id' => $class_id, 'work_id' => $work_id])->delete();
    }
}