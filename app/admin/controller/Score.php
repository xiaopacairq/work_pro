<?php

namespace app\admin\controller;

use think\facade\Request;
use think\facade\View;


use app\common\model\admin\Classes as ClassesModel;
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

        $data['work'] = $this->scoreBusiness->getStuScoreList($class_id)['work'];
        $data['work_count'] = $this->scoreBusiness->getStuScoreList($class_id)['work_count'];
        $data['stu'] = $this->scoreBusiness->getStuScoreList($class_id)['stu'];

        View::engine()->layout('layout');
        return View::fetch('score/index', $data);
    }

    // 成绩导出
    public function get_zip()
    {
        $class_id = (int)Request::get('class_id', '');
        $this->scoreBusiness->getZip($class_id);
    }
}