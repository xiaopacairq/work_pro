<?php

namespace app\common\business\home;


use app\common\model\Work as WorkModel;
use app\common\model\Stu as StuModel;
use app\common\model\Score as ScoreModel;
use app\common\model\IsWork as IsWorkModel;
use app\common\model\Works as WorksModel;

/**
 * 执行核心逻辑
 */
class DisWork
{
    private $workModel = null;
    private $stuModel = null;
    private $scoreModel = null;
    private $isWorkModel = null;
    private $worksModel = null;


    public function __construct()
    {
        // 核心逻辑
        $this->workModel = new WorkModel();
        $this->scoreModel = new ScoreModel();
        $this->stuModel = new StuModel();
        $this->isWorkModel = new IsWorkModel();
        $this->worksModel = new WorksModel();
    }

    /**
     * 作业主页数据
     */
    public function getWorkList($class)
    {
        $data['work'] = $this->workModel->getWorkList($class['class_id']);

        foreach ($data['work'] as $k => $v) {
            $data['work'][$k]['stu_num'] = $this->stuModel->getStuCount($class['class_id']); //学生总人数
            $data['work'][$k]['is_true_stu_num'] = $this->isWorkModel->getStuIsTrueCount($class['class_id'], $data['work'][$k]['work_id']);
        }

        return $data['work'];
    }

    /**
     * 作业展示数据
     */
    public function getWorkDisplayList($class, $work_id)
    {

        $data['works'] = $this->stuModel->getStuListByClassId($class['class_id']);
        foreach ($data['works'] as $k => $v) {
            $res  = $this->isWorkModel->getIsWorkStu($class['class_id'], $v['stu_no'], $work_id);
            if (!empty($res)) { //如果学生已点击
                if ($res['is_true'] == 1) { //如果学生点击作业且确认上传
                    $data['works'][$k]['is_true'] = 1;
                    $data['works'][$k]['work_id'] = $work_id;
                    $data['works'][$k]['save_time'] = $res['last_time']; //提交作业时间

                    $data['works'][$k]['remark_count'] = $this->scoreModel->getStuScoreCount($class['class_id'], $v['stu_no'], $work_id);
                    $data['works'][$k]['remark_stu'] = $this->scoreModel->getToStuScoreList($class['class_id'], $v['stu_no'], $work_id);
                } else { //学生点击作业，但未上传
                    $data['works'][$k]['is_true'] = 0;
                    $data['works'][$k]['work_id'] = $work_id;
                    $data['works'][$k]['save_time'] = 0; //提交作业时间
                    $data['works'][$k]['remark_count'] = 0; //评价人数为0
                    $data['works'][$k]['remark_stu'] =  $this->scoreModel->getToStuScoreList($class['class_id'], $v['stu_no'], $work_id);
                }
            } else { //如果学生未点击作业
                $data['works'][$k]['is_true'] = -1;
                $data['works'][$k]['work_id'] = $work_id;
                $data['works'][$k]['save_time'] = 0; //提交作业时间
                $data['works'][$k]['remark_count'] = 0; //评价人数为0
                $data['works'][$k]['remark_stu'] = []; //当前评价状态未知
            }
        }

        return $data['works'];
    }
}
