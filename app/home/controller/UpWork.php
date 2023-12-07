<?php

namespace app\home\controller;

use think\facade\Request;
use think\facade\View;


use app\common\model\Classes as ClassesModel;
use app\common\model\Stu as StuModel;
use app\common\business\home\UpWork as UpWorkBusiness;
use app\common\model\Work as WorkModel;
use app\common\model\IsWork as IsWorkModel;
use app\common\model\Works as WorksModel;


/**
 * 作业上传
 * 
 * 
 */
class UpWork extends Base
{
    private $classesModel = null;
    private $stuModel = null;
    private $upWorkBusiness = null;
    private $workModel = null;
    private $isWorkModel = null;
    private $worksModel = null;

    public function __construct()
    {
        // 核心逻辑
        $this->classesModel = new ClassesModel();
        $this->stuModel = new StuModel();
        $this->upWorkBusiness = new UpWorkBusiness();
        $this->workModel = new WorkModel();
        $this->isWorkModel = new IsWorkModel();
        $this->worksModel = new WorksModel();
        $this->initialize();
    }

    public function index()
    {
        $data['class_id'] = $this->class_id;
        $data['stu_no'] = $this->stu_no;
        $data['class'] = $this->classesModel->findClasses($data['class_id']);
        $data['stu'] = $this->stuModel->findStu($data['class_id'], $data['stu_no']);
        $data['recent_date'] = date("Y-m-d H:i", time());
        $data['class']['title'] = '作业上传';

        $data['work'] = $this->upWorkBusiness->getWorkList($data['class'], $data['stu']);


        View::engine()->layout('layout');
        return View::fetch('up_work/index', $data);
    }

    // 主页面
    public function details()
    {

        $data['class_id'] = $this->class_id;
        $data['stu_no'] = $this->stu_no;
        $data['class'] = $this->classesModel->findClasses($data['class_id']);
        $data['stu'] = $this->stuModel->findStu($data['class_id'], $data['stu_no']);
        $data['work_id'] = (int)Request::get('work_id', '');  //当前作业号
        $data['recent_date'] = date("Y-m-d H:i", time());  //当前的时间，与作业时间对比
        $data['work'] = $this->workModel->findWorkToStu($data['class_id'], $data['work_id']);  //获取当前作业的信息,包括截止时间和作业的状态，确保作业在截止时间结束后或状态关闭时，是无法上传作业的！

        if ($data['work']->isEmpty()) {
            return $this->show(
                config("status.error"),
                config("message.error"),
                '非法进入'
            );
        }

        $data['is_work'] = $this->isWorkModel->getIsWorkStu($data['class_id'], $data['stu_no'], $data['work_id']);
        if ($data['is_work']->isEmpty()) {
            //如果没有查询到对应的is_work的数据，则添加一条数据
            $this->isWorkModel->addIsWork($data['class_id'], $data['stu_no'], $data['work_id']);
        }
        $data['is_work'] = $this->isWorkModel->getIsWorkStu($data['class_id'], $data['stu_no'], $data['work_id']);


        $data['works'] = $this->worksModel->getWorkFileList($data['class_id'], $data['stu_no'], $data['work_id']);


        return View::fetch('up_work/details', $data);
    }

    //确认上传作业
    public function isTrue()
    {
        $data['class_id'] = $this->class_id;
        $data['stu_no'] = $this->stu_no;

        $data['work_id'] = (int)Request::post('work_id', '');
        $data['is_true'] = (int)Request::post('is_true', '0');
        $data['last_time'] = date("Y-m-d H:i:s", time());

        $res =  $this->workModel->findWork($data['class_id'], $data['work_id']);  //获取当前作业的信息,包括截止时间和作业的状态，确保作业在截止时间结束后或状态关闭时，是无法上传作业的！
        if ($res['status'] == 1) {
            return $this->show(
                config("status.error"),
                config("message.error"),
                '作业已关闭'
            );
        }

        // 如果确认提交，要确保提交文件中至少有一个index文件
        if ($data['is_true'] == 1) {
            $res = $this->worksModel->findIndex($data['class_id'], $data['stu_no'], $data['work_id']);
            if ($res->isEmpty()) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '至少要包含一个 index 文件'
                );
            }
        }


        // 执行修改操作
        $this->isWorkModel->editIsWorkStatus($data['class_id'], $data['stu_no'], $data['work_id'], $data);
        if ($data['is_true'] == 0) {
            return $this->show(
                config("status.success"),
                config("message.success"),
                '取消成功'
            );
        } else {
            return $this->show(
                config("status.success"),
                config("message.success"),
                '保存成功'
            );
        }
    }

    // 上传文件
    public function upfile()
    {
        $data['class_id'] = $this->class_id;
        $data['stu_no'] = $this->stu_no;
        $data['work_id'] = (int)Request::post('work_id', '');

        $file = Request::file('file');

        $errCode = $this->upWorkBusiness->upfile($file, $data['class_id'], $data['stu_no'], $data['work_id']);
        if ($errCode != config('status.success')) {
            if ($errCode == config('status.work_file_max_err')) {
                return $this->show(
                    config("status.work_file_max_err"),
                    config("message.work_file_max_err"),
                    '上传文件数量超过15个'
                );
            } else if ($errCode == config('status.work_file_ext_err')) {
                return $this->show(
                    config("status.work_file_ext_err"),
                    config("message.work_file_ext_err"),
                    '文件后缀不允许上传'
                );
            } else {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '文件上传错误'
                );
            }
        }
        return $this->show(
            config("status.success"),
            config("message.success"),
            '文件上传成功'
        );
    }

    // 删除文件
    public function delfile()
    {
        $data['class_id'] = $this->class_id;
        $data['stu_no'] = $this->stu_no;
        $data['work_id'] = (int)Request::post('work_id', '');

        $id = (int)Request::post('id', '');

        $errCode = $this->upWorkBusiness->delfile($id);

        if ($errCode != config('status.success')) {
            return $this->show(
                config("status.error"),
                config("message.error"),
                '文件删除失败'
            );
        }
        return $this->show(
            config("status.success"),
            config("message.success"),
            '文件删除成功'
        );
    }
}
