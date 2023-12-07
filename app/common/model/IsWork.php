<?php

namespace app\common\model;

use think\Model;

/**
 * 作业提交确认表
 */
class IsWork extends Model
{
    protected $table = 'is_work';

    /**
     * 获取作业中间表信息
     */
    public function getIsWorkList($class_id)
    {
        //获取所有的作业
        $res = $this->field('stu_no,work_id,is_true')->where('class_id', $class_id)->select()->toArray();
        return $res;
    }

    /**
     * 获取作业中间表的数据
     */
    public function getIsWorkStu($class_id, $stu_no, $work_id)
    {
        $res = $this
            ->where(['class_id' => $class_id, 'stu_no' => $stu_no, 'work_id' => $work_id])
            ->findOrEmpty();

        return $res;
    }

    /**
     * 获取已提交作业的学生
     */
    public function getStuIsTrueCount($class_id, $work_id)
    {
        $res = $this
            ->where(['class_id' => $class_id, 'work_id' => $work_id, 'is_true' => 1])->count();;
        return $res;
    }

    /**
     * 删除作业 中间表 文件数据
     */
    public function delIsWork($class_id, $stu_no = null)
    {
        if (empty($stu_no)) {
            $this->where('class_id', $class_id)->delete();
        } else {
            $this->where(['class_id' => $class_id])->delete();
        }
    }

    /**删除作业 */
    public function delIsWorkByWorkId($class_id, $work_id)
    {
        $this->where(['class_id' => $class_id, 'work_id' => $work_id])->delete();
    }

    /**
     * 判断作业中间表is_work，学生确定作业的状态
     */
    public function findStuWorkStatusByIsWork($stu_no, $work_id)
    {
        $res = $this->where(['stu_no' => $stu_no, 'work_id' => $work_id])->findOrEmpty();
        return $res;
    }

    /**
     * 插入is_work中间表数据
     */
    public function addIsWork($class_id, $stu_no, $work_id)
    {
        $this
            ->insert([
                'class_id' => $class_id,
                'work_id' => $work_id,
                'stu_no' => $stu_no,
                'is_true' => '0',
                'last_time' => date("Y-m-d H:i", time())
            ]);
    }

    /**
     * 修改 isWork 数据表 学生提交作业的状态
     */
    public function editIsWorkStatus($class_id, $stu_no, $work_id, $data)
    {
        $this->where(['class_id' => $class_id, 'stu_no' => $stu_no, 'work_id' => $work_id])->update($data);
    }
}
