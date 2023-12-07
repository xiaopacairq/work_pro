<?php

namespace app\common\model;

use think\Model;

use think\facade\Db;

class Score extends Model
{
    protected $table = 'score';

    /**
     * 计算学生单次作业分数
     */
    public function getStuScore($stu_no, $work_id)
    {
        $res = $this->where(['stu_no' => $stu_no, 'work_id' => $work_id])->sum('score');
        return $res;
    }

    /**
     * 获取学生评分详情
     */
    public function getScoreList($class_id, $work_id, $stu_no)
    {
        $res = $this->where(['class_id' => $class_id, 'work_id' => $work_id, 'stu_no' => $stu_no])->select();
        return $res;
    }

    /**
     * 获取作业中间表信息
     */
    public function getScoreGroupList($class_id)
    {
        //获取所有的作业
        $res =
            $this->field('stu_no,class_id,work_id,sum(score)  score_all')->where('class_id', $class_id)->group('stu_no,class_id,work_id')->select()->toArray();
        return $res;
    }

    /**
     * 删除评分数据
     */
    public function delScore($class_id, $stu_no = null)
    {
        if (empty($stu_no)) {
            $this->where('class_id', $class_id)->delete();
        } else {
            $this->where(['stu_no' => $stu_no, 'class_id' => $class_id])->delete();
        }
    }
    /**删除作业 */
    public function delScoreByWorkId($class_id, $work_id)
    {

        $this->where(['class_id' => $class_id, 'work_id' => $work_id])->delete();
    }
}