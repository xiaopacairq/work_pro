<?php

namespace app\admin\controller;

use think\facade\Request;
use think\facade\View;
use think\facade\Db;

use think\exception\ValidateException;

use app\common\model\admin\Classes as ClassesModel;
use app\common\model\admin\Score as ScoreModel;
use app\common\model\admin\Work as WorkModel;
use app\common\business\admin\Work as WorkBuisness;
use app\common\validate\admin\Work as WorkValidate;


/**
 * 后台作业管理页
 */
class Work extends Base
{
    private $scoreModel = null;
    private $workBuisness = null;
    private $classesModel = null;
    private $workModel = null;

    public function __construct()
    {
        // 核心逻辑
        $this->scoreModel = new ScoreModel();
        $this->workBuisness = new WorkBuisness();
        $this->classesModel = new ClassesModel();
        $this->workModel = new WorkModel();
        $this->initialize();
    }

    /**
     * 作业管理主页
     */
    public function index()
    {
        $class_id = (int)Request::get('class_id', '');
        $data['class'] = $this->classesModel->findClasses($class_id)->toArray();
        $data['admin'] = $this->uname;


        $data['recent_date'] = date("Y-m-d H:i", time());
        $data['class']['title'] = '作业布置';

        $data['work'] = $this->workModel->getWorkList($class_id);

        View::engine()->layout('layout');
        return View::fetch('work/index', $data);
    }

    /**
     * 作业添加
     */
    public function add()
    {
        if (Request::isPost()) {
            if (false === Request::checkToken('__token__')) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '请勿重复提交'
                );
            }

            $data['class_id'] = (int)Request::post('class_id', '');
            $data['work_id'] = (int)Request::post('work_id', '');
            $data['work_remarks'] = trim(Request::post('work_remarks', ''));
            $data['work_last_time'] = Request::post('work_last_time', '');
            $data['status'] = (int)Request::post('status', '0');

            //验证类判断
            try {
                validate(WorkValidate::class)->scene('add')->check($data);
            } catch (ValidateException $e) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    $e->getMessage(),
                );
            }

            $isWork = $this->workModel->findWork($data['class_id'], $data['work_id']);
            if (!$isWork->isEmpty()) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '作业编号已存在'
                );
            }

            $data['work_start_time'] = date('Y-m-d H:i:s', time());

            $this->workModel->addWork($data);

            return $this->show(
                config("status.success"),
                config("message.success"),
                '添加成功'
            );
        } else {

            $data['token'] = Request::buildToken('__token__', 'sha1');
            $data['class_id'] = (int)Request::get('class_id', '');
            return View::fetch('work/add', $data);
        }
    }


    /**
     * 作业修改
     */
    public function edit()
    {
        if (Request::isPost()) {

            $class_id = (int)Request::post('class_id', '');
            $work_id = (int)Request::post('work_id', '');
            $data['work_remarks'] = trim(Request::post('work_remarks', ''));
            $data['work_last_time'] = Request::post('work_last_time', '');
            $data['status'] = (int)Request::post('status', '0');


            //验证类判断
            try {
                validate(WorkValidate::class)->scene('edit')->check($data);
            } catch (ValidateException $e) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    $e->getMessage(),
                );
            }
            $data['work_start_time'] = date('Y-m-d H:i:s', time());


            $this->workModel->editWork($class_id, $work_id, $data);


            return $this->show(
                config("status.success"),
                config("message.success"),
                '修改成功'
            );
        } else {
            $data['class_id'] = (int)Request::get('class_id', '');
            $data['work_id'] = (int)Request::get('work_id', '');

            // 获取单个作业
            $data['work'] = $this->workModel->findWork($data['class_id'], $data['work_id'])->toArray();

            //循环班级所有作业
            $data['works'] = $this->workBuisness->getDetail($data['class_id'], $data['work_id']);

            return View::fetch('work/edit', $data);
        }
    }

    /**
     * 删除
     */
    public function del()
    {

        $id = (int)Request::post('id', '');  //删除单条作业
        $class_id = (int)Request::post('class_id', '');
        $work_id = Request::post('work_id', '');  //删除作业的score、is_work、works记录

        $this->workBuisness->del($id, $class_id, $work_id);

        return $this->show(
            config("status.success"),
            config("message.success"),
            '删除成功'
        );
    }

    /**
     * 作业导出
     */
    public function getZip()
    {
        $class_id = (int)Request::get('class_id', '');

        $this->workBuisness->getZip($class_id);
    }

    /**
     * 作业评价详情
     */
    public function detail()
    {
        $class_id = Request::get('class_id', '');

        $data['stu_no'] = (int)Request::get('stu_no', '');
        $data['work_id'] = (int)Request::get('work_id', '');
        $data['score'] = $this->scoreModel->getScoreList($class_id, $data['work_id'], $data['stu_no']);

        return View::fetch('work/detail', $data);
    }
}