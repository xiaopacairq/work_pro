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
}