<?php

namespace app\home\controller;

use think\facade\Db;
use think\facade\Request;
use think\facade\View;

use app\common\business\home\DisWork as DisWorkBusiness;

use app\common\model\Classes as ClassesModel;
use app\common\model\Score as ScoreModel;
use app\common\model\Stu as StuModel;

/**
 * 作业提交页面
 */
class DisWork extends Base
{
    private $classesModel = null;
    private $disWorkBusiness = null;
    private $stuModel = null;
    private $scoreModel = null;

    public function __construct()
    {
        // 核心逻辑
        $this->classesModel = new ClassesModel();
        $this->disWorkBusiness = new DisWorkBusiness();
        $this->stuModel = new StuModel();
        $this->scoreModel = new ScoreModel();
        $this->initialize();
    }

    public function index()
    {
        $data['class_id'] = $this->class_id;
        $data['stu_no'] = $this->stu_no;
        $data['class'] = $this->classesModel->findClasses($data['class_id']);
        $data['stu'] = $this->stuModel->findStu($data['class_id'], $data['stu_no']);

        $data['class']['title'] = '作业展示';

        $data['work'] = $this->disWorkBusiness->getWorkList($data['class']);


        View::engine()->layout('layout');
        return View::fetch('dis_work/index', $data);
    }

    public function display()
    {
        $data['class_id'] = $this->class_id;
        $data['stu_no'] = $this->stu_no;
        $data['class'] = $this->classesModel->findClasses($data['class_id']);
        $data['stu'] = $this->stuModel->findStu($data['class_id'], $data['stu_no']);
        $data['work_id'] = (int)Request::get('work_id', '');

        $data['works'] = $this->disWorkBusiness->getWorkDisplayList($data['class'], $data['work_id']);

        return View::fetch('dis_work/display', $data);
    }

    public function remarks()
    {
        $data['class_id'] = $this->class_id;

        if (Request::isPost()) {
            $data['work_id'] = (int)Request::post('work_id', '');
            $data['stu_no'] = (int)Request::post('stu_no', '');  //被评分的学号
            $data['to_stu_no'] =  $this->stu_no;  //参与评分的学号
            $data['score'] = (int)Request::post('score', '');
            $data['start_time'] = date("Y-m-d H:i:s", time());  //评分时间

            $res = $this->scoreModel->findScore($data['class_id'], $data['stu_no'], $data['work_id'], $data['to_stu_no']);

            if (!$res->isEmpty()) { //如果已经评分过了，执行修改评分操作
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '评分后不允许修改'
                );
            } else { //如果没有评分过，执行添加评分记录
                $this->scoreModel->addScore($data);
                return $this->show(
                    config("status.success"),
                    config("message.success"),
                    '评分成功'
                );
            }
            exit(json_encode(['code' => 1, 'msg' => "评分失败"]));
        } else {
            // 第一次请求页面
            $data['work_id'] = (int)Request::get('work_id', '');

            $data['stu_no'] = Request::get('stu_no', '');  //作业归宿者
            $data['to_stu_no'] =  $this->stu_no;  //作业评价者
            $data['score'] = 30;
            $data['is_true'] = false; //提交状态，默认为false


            $data['remarks'] = $this->scoreModel->getStuScoreList($data['class_id'], $data['stu_no'], $data['work_id']);

            $res = $this->scoreModel->findScore($data['class_id'], $data['stu_no'], $data['work_id'], $data['to_stu_no']);

            if (!$res->isEmpty()) {
                $data['is_true'] = true; //已经提交过了
                $data['score'] = $res['score'];
            }
            // print_r($res);
            return View::fetch('dis_work/remarks', $data);
        }
    }
}
