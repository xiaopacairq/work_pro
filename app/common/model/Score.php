<?php

namespace app\common\model;

use think\Model;

use think\facade\Db;

class Score extends Model
{
    protected $table = 'score';

    /**
     * 获取学生是否已经评分
     */
    public function findScore($class_id, $stu_no, $work_id, $to_stu_no)
    {
        $res = $this
            ->where([
                'class_id' => $class_id,
                'work_id' => $work_id,
                'stu_no' => $stu_no,
                'to_stu_no' => $to_stu_no
            ])->findOrEmpty();
        return $res;
    }

    /**
     * 计算学生单次作业分数
     */
    public function getStuScore($class_id, $stu_no, $work_id)
    {
        $res = $this->where(['class_id' => $class_id, 'stu_no' => $stu_no, 'work_id' => $work_id])->sum('score');
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
     * 获取作业评分列表
     */
    public function getStuScoreList($class_id, $stu_no, $work_id)
    {
        $res = $this->where([
            'class_id' => $class_id,
            'work_id' => $work_id,
            'stu_no' => $stu_no,
        ])->order('score', "desc")->select();
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


    /**获取学生评分数 */
    public  function getStuScoreCount($class_id, $stu_no, $work_id)
    {
        $res = $this->where(['class_id' => $class_id, 'stu_no' => $stu_no, 'work_id' => $work_id])->count();
        return $res;
    }

    /**
     * 获取评价状态 ，to_stu_no
     */
    public function getToStuScoreList($class_id, $stu_no, $work_id)
    {
        $res  = $this->field('to_stu_no')->where(['class_id' => $class_id, 'stu_no' => $stu_no, 'work_id' => $work_id])->select()->toArray(); //当前评价状态
        return $res;
    }

    /**
     * 插入score
     */
    public function addScore($data)
    {
        Db::table('score')->insert($data);
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
