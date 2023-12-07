<?php

namespace app\admin\controller;

use think\facade\Request;
use think\facade\View;

use app\common\validate\admin\Classes as ClassesValidate;

use app\common\model\Classes as ClassesModel;

use think\exception\ValidateException;


/**
 * 后台班级信息详情页
 */
class Home extends Base
{
    private $classesModel = null;

    public function __construct()
    {
        // 核心逻辑
        $this->classesModel = new ClassesModel();
        $this->initialize();
    }

    public function index()
    {
        if (Request::isPost()) { //修改数据

            $class_id = (int)Request::post('class_id', '');
            $data['class_name'] = trim(Request::post('class_name', ''));
            $data['class_time'] = trim(Request::post('class_time', ''));
            $data['remarks'] = trim(Request::post('remarks', ''));

            //验证类判断
            try {
                validate(ClassesValidate::class)->scene('home_edit')->check($data);
            } catch (ValidateException $e) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    $e->getMessage()
                );
            }

            if (false === Request::checkToken('__token__')) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '请勿重复提交'
                );
            }

            $this->classesModel->updateClasses($class_id, $data);

            return $this->show(
                config("status.success"),
                config("message.success"),
                '更新成功'
            );
        } else { //页面展示
            $data['token'] = Request::buildToken('__token__', 'sha1');
            $data['admin'] = $this->uname;
            $class_id = (int)Request::get('class_id');
            $data['class'] = $this->classesModel->findClasses($class_id);
            $data['class']['title'] = '班级配置';  //动态设置网站名称

            View::engine()->layout('layout');
            return view('home/index', $data);
        }
    }
}
