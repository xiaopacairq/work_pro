<?php

namespace app\common\business\home;

use think\facade\Filesystem;

use app\common\model\home\Work as WorkModel;
use app\common\model\home\Stu as StuModel;
use app\common\model\home\Score as ScoreModel;

use file\File;




/**
 * 执行核心逻辑
 */
class Work
{
    private $workModel = null;
    private $stuModel = null;
    private $scoreModel = null;
    private $file = null;


    public function __construct()
    {
        // 核心逻辑
        $this->file = new File();
        $this->workModel = new WorkModel();
        $this->scoreModel = new ScoreModel();
        $this->stuModel = new StuModel();
    }

    /**
     * 作业主页数据
     */
    public function getWorkList($class, $stu)
    {
        $data['work'] = $this->workModel->getWorkList($class['class_id']);

        foreach ($data['work'] as $k => $v) {
            $res = $this->workModel->getIsWorkStu($class['class_id'], $stu['stu_no'], $v['work_id']);
            if (!empty($res)) { //可以查到对应的数据，学生已确认

                if ($res['is_true'] == 1) { //学生已提交

                    $data['work'][$k]['stu_no'] = $stu['stu_no'];
                    $data['work'][$k]['is_true'] = 1;
                    $score_sum = $this->scoreModel->getStuScore($class['class_id'], $stu['stu_no'], $v['work_id']);
                    $stu_count = $this->stuModel->getStuCount($class['class_id']); //学生总人数

                    $data['work'][$k]['all_score'] = number_format($score_sum / $stu_count, 2);
                } else {
                    // 学生未提交
                    $data['work'][$k]['stu_no'] = $stu['stu_no'];
                    $data['work'][$k]['is_true'] = 0;
                }
            } else { //不能查到对应的数据，学生未确认
                $data['work'][$k]['stu_no'] = $stu['stu_no'];
                $data['work'][$k]['is_true'] = -1;
            }
        }
        return $data['work'];
    }

    /**
     * 处理 上传 文件
     */
    public function upfile($file, $class_id, $stu_no, $work_id)
    {
        $data['filename'] = $file->getOriginalName();
        $data['class_id'] = $class_id;
        $data['stu_no'] = $stu_no;
        $data['work_id'] = $work_id;

        $count = $this->workModel->getWorksCount($class_id, $stu_no, $work_id);  //当前文件个数
        if ($count > 15) {
            return config('status.work_file_ext_err');
        }


        $data['work_url'] = "storage" . "/" . $class_id . "/stu_work" . "/" . $work_id . "/" . $stu_no . "/" . $data['filename'];
        $data['start_time'] = date("Y-m-d H:i:s", time());

        $errCode = $this->checkExt($file);
        if ($errCode == config('status.work_file_ext_err')) {
            return config('status.work_file_ext_err');
        }

        $res = $this->workModel->findWorksFilename($data['filename'], $class_id, $stu_no, $work_id);

        if (!empty($res)) {
            // 修改操作
            $this->workModel->editWorksStartTime($data['filename'], $class_id, $stu_no, $work_id);
            $errCode = $this->putFile($file, $class_id, $work_id, $stu_no);
        } else {  //添加操作
            $this->workModel->addWorks($data);
            $errCode = $this->putFile($file, $class_id, $work_id, $stu_no);
        }
        return config('status.success');
    }


    /**
     * 上传文件
     */
    private function putFile($file, $class_id, $work_id, $stu_no)
    {
        $savename = \think\facade\Filesystem::disk('public')->putFileAs($class_id . "/stu_work" . "/" . $work_id . '/' . $stu_no, $file, $file->getOriginalName());
        if (!$savename) {
            return config('status.error');
        }
        return config('status.success');
    }

    /**
     * 删除作业文件
     */
    public function delfile($id)
    {
        $res = $this->workModel->findWorks($id);

        $this->workModel->delWorks($id);

        $this->clearFile($res['work_url']);


        return config('status.success');
    }

    /**
     * 校验文件格式
     */
    private function checkExt($file)
    {
        $file_ext = $file->extension();

        $exts = ['php', 'sql', 'html', 'css', 'js', 'jpg', 'png', 'gif', 'bmp', 'jpeg', 'svg', 'webp', 'ico', 'pdf'];

        // 校验文件格式
        if (!in_array($file_ext, $exts)) {
            return config('status.work_file_ext_err');
        }
        return config('status.success');
    }



    /**
     * 清除文件
     */
    private function clearFile($work_url)
    {
        $this->file->unlink_file($work_url);
    }
}
