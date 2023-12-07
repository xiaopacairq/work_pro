<?php

namespace app\admin\controller;

use think\facade\Request;
use think\facade\View;


use app\common\model\Classes as ClassesModel;
use app\common\business\admin\Score as ScoreBusiness;


/**
 * 后台学生成绩
 */
class Score extends Base
{
    private $classesModel = null;
    private $scoreBusiness = null;

    public function __construct()
    {
        // 核心逻辑
        $this->classesModel = new ClassesModel();
        $this->scoreBusiness = new ScoreBusiness();
        $this->initialize();
    }

    public function index()
    {
        $class_id = (int)Request::get('class_id', '');

        $data['class'] = $this->classesModel->findClasses($class_id)->toArray();
        $data['admin'] = $this->uname;
        $data['class']['title'] = '成绩管理';

        $res = $this->scoreBusiness->getStuScoreList($class_id);
        $data['work'] = $res['work'];
        $data['work_count'] = $res['work_count'];
        $data['stu'] = $res['stu'];

        View::engine()->layout('layout');
        return View::fetch('score/index', $data);
    }

    // 成绩导出
    public function getZip()
    {
        $class_id = (int)Request::get('class_id', '');
        $this->scoreBusiness->getZip($class_id);
    }
}
