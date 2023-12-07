<?php

namespace app\home\controller;

use app\common\model\Classes as ClassesModel;
use app\common\model\Stu as StuModel;


use think\facade\View;

/**
 * 主页面
 */
class Home extends Base
{
    private $classesModel = null;
    private $stuModel = null;

    public function __construct()
    {
        // 核心逻辑
        $this->classesModel = new ClassesModel();
        $this->stuModel = new StuModel();
        $this->initialize();
    }

    public function index()
    {
        $data['class_id'] = $this->class_id;
        $data['stu_no'] = $this->stu_no;
        $data['class'] = $this->classesModel->findClasses($data['class_id']);
        $data['stu'] = $this->stuModel->findStu($data['class_id'], $data['stu_no']);
        $data['class']['title'] = '学生主页';

        View::engine()->layout('layout');
        return View::fetch('home/index',  $data);
    }
}
