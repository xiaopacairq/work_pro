<?php

namespace app\common\model\home;

use think\Model;

use think\facade\Db;

class Score extends Model
{
    protected $table = 'score';

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
     * 获取所有学生的信息
     */
    public function getStuList($class_id)
    {
        //获取所有的学生
        $res = Db::table('stu')->field('stu_no,stu_name')->where('class_id', $class_id)->order('stu_no', 'asc')->select()->toArray();
        return $res;

        Db::table('work')->where(['class_id' => $class_id, 'status' => 0])->select()->toArray();
    }

    /**
     * 获取所有作业的信息
     */
    public function getWorkList($class_id)
    {
        //获取所有的作业
        $res = Db::table('work')->where(['class_id' => $class_id, 'status' => 0])->select()->toArray();
        return $res;
    }

    /**
     * 获取作业中间表信息
     */
    public function getIsWorkList($class_id)
    {
        //获取所有的作业
        $res = Db::table('is_work')->field('stu_no,work_id,is_true')->where('class_id', $class_id)->select()->toArray();
        return $res;
    }

    /**
     * 获取作业中间表信息
     */
    public function getScoreGroupList($class_id)
    {
        //获取所有的作业
        $res = Db::table('score')->field('stu_no,class_id,work_id,sum(score)  score_all')->where('class_id', $class_id)->group('stu_no,class_id,work_id')->select()->toArray();
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
     * 插入score
     */
    public function addScore($data)
    {
        Db::table('score')->insert($data);
    }

    /**
     * 获取作业评分列表
     */
    public function getStuScoreList($class_id, $stu_no, $work_id)
    {
        $res = Db::table('score')->where([
            'class_id' => $class_id,
            'work_id' => $work_id,
            'stu_no' => $stu_no,
        ])->order('score', "desc")->select();
        return $res;
    }
}
