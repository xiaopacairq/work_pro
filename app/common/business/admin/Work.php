<?php

namespace app\common\business\admin;

use file\File;
use file\Zip1;

use app\common\model\admin\Score as ScoreModel;
use app\common\model\admin\Stu as StuModel;
use app\common\model\admin\Work as WorkModel;

/**
 * 执行核心逻辑
 */
class Work
{

    private $scoreModel = null;
    private $stuModel = null;
    private $workModel = null;
    private $zip1 = null;

    public function __construct()
    {
        $this->zip1 = new Zip1();
        $this->scoreModel = new ScoreModel();
        $this->stuModel = new StuModel();
        $this->workModel = new WorkModel();
    }

    /**
     * 获取压缩包
     */
    public function getZip($class_id)
    {
        $this->zip1->zip($class_id, 'stu_work');
    }

    /**
     * 删除作业
     */
    public function del($id, $class_id, $work_id)
    {
        $file = new file();
        if (file_exists("storage" . "/" . $class_id . '/stu_work' . '/' . $work_id)) { //判断文件是否存在
            //删除单条数据
            $file->remove_dir("storage" . "/" . $class_id . '/stu_work' . '/' . $work_id, true); //清空作业目录
        }

        $this->workModel->delWork($id, $class_id, $work_id);
    }

    /**
     * 获取学生作业提交详情
     */
    public function getDetail($class_id, $work_id)
    {
        //循环班级所有学生作业信息
        $data['works'] = $this->stuModel->getStuListToExcel($class_id);
        $stu_count = count($data['works']);

        foreach ($data['works'] as $k => $v) {
            $res = $this->workModel->findStuWorkStatusByIsWork($v['stu_no'], $work_id);
            if (!empty($res)) { //如果学生已点击
                if ($res['is_true'] == 1) { //如果学生点击作业且确认上传
                    $data['works'][$k]['is_true'] = $res['is_true'];
                    $data['works'][$k]['work_id'] = $work_id;
                    $data['works'][$k]['save_time'] = $res['last_time']; //提交作业时间

                    $score_sum = $this->scoreModel->getStuScore($v['stu_no'], $work_id);  //获取的总分
                    $data['works'][$k]['all_score'] = number_format($score_sum / $stu_count, 2);
                } else { //学生点击作业，但未上传
                    $data['works'][$k]['is_true'] = 0;
                    $data['works'][$k]['work_id'] = $work_id;
                    $data['works'][$k]['save_time'] = 0; //提交作业时间
                    $data['works'][$k]['all_score'] = 0; //分数为0
                }
            } else { //如果学生未点击作业
                $data['works'][$k]['is_true'] = -1;
                $data['works'][$k]['work_id'] = $work_id;
                $data['works'][$k]['save_time'] = 0; //提交作业时间
                $data['works'][$k]['all_score'] = 0; //分数为0
            }
        }
        return $data['works'];
    }
}