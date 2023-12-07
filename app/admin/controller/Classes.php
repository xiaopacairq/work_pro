<?php

namespace app\admin\controller;

use think\facade\Request;

use app\common\validate\admin\Admin;
use app\common\validate\admin\Classes as ClassesValidate;
use app\common\business\admin\Classes as ClassesBusiness;

use app\common\model\Classes as ClassesModel;
use app\common\model\Admin as AdminModel;
use app\common\model\Stu as StuModel;
use app\common\model\Work as WorkModel;
use app\common\model\IsWork as IsWorkModel;
use app\common\model\Works as WorksModel;
use app\common\model\Score as ScoreModel;

use think\exception\ValidateException;

/**
 * 班级管理页
 */
class Classes extends Base
{
    private $classesBusiness = null;
    private $classesModel = null;
    private $adminModel = null;
    private $stuModel = null;
    private $workModel = null;
    private $isWorkodel = null;
    private $worksModel = null;
    private $scoreModel = null;

    public function __construct()
    {
        // 核心逻辑
        $this->classesBusiness = new ClassesBusiness();
        $this->classesModel = new ClassesModel();
        $this->adminModel = new AdminModel();
        $this->stuModel = new StuModel();
        $this->workModel = new WorkModel();
        $this->isWorkodel = new IsWorkModel();
        $this->worksModel = new WorksModel();
        $this->scoreModel = new ScoreModel();
        $this->initialize();
    }

    /**
     * 管理员信息修改
     */
    public function information()
    {
        if (Request::isPost()) { //修改数据
            $id = (int)Request::post('id', '');
            $data['pwd'] = Request::post('pwd', '');
            $data['email'] = Request::post('email', '');
            $data['email_system'] = Request::post('email_system', '');
            $data['check_code'] = Request::post('check_code', '');
            $data['server_ip'] = Request::post('server_ip', '');

            //验证类判断
            try {
                validate(Admin::class)->scene('edit')->check($data);
            } catch (ValidateException $e) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    $e->getMessage()
                );
            }

            // 禁止重复请求
            if (false === Request::checkToken('__token__')) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '请勿重复提交'
                );
            }

            $this->adminModel->editAdmin($id, $data);

            return $this->show(
                config("status.success"),
                config("message.success"),
                '更新成功'
            );
        } else { //页面展示
            $id = $this->uname_id;
            $data['admin'] = $this->adminModel->findAdmin($id);

            return view('classes/information', $data);
        }
    }

    /**
     * 班级管理页视图
     */
    public function index()
    {
        $data['uname'] = $this->uname;
        $data['classes'] = $this->classesModel->getClassesList();

        return view('classes/index', $data);
    }

    /**
     * 班级信息insert
     */
    public function add()
    {
        if (Request::isPost()) {
            // 执行添加
            $data['class_id'] = trim(Request::post('class_id', ''));
            $data['class_name'] = trim(Request::post('class_name', ''));
            $data['status'] = trim(Request::post('status', ''));
            $data['class_time'] = trim(Request::post('class_time', ''));
            $data['remarks'] = trim(Request::post('remarks', ''));

            //验证类判断
            try {
                validate(ClassesValidate::class)->scene('add')->check($data);
            } catch (ValidateException $e) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    $e->getMessage(),
                );
            }

            // 班级代码重复性判断
            $isClasses = $this->classesModel->findClasses($data['class_id']);
            if (!$isClasses->isEmpty()) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '班级代码已存在'
                );
            }

            if (false === Request::checkToken('__token__')) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '请勿重复提交'
                );
            }

            $data['start_time'] = date("Y-m-d H:i:s", time());


            // 创建excel表格，保存班级数据
            $errCode = $this->classesBusiness->createFile($data['class_id']);
            if ($errCode != config('status.success')) {
                if ($errCode == config('status.error')) {
                    return $this->show(
                        config("status.error"),
                        config("message.error"),
                        '文件夹创建失败'
                    );
                } else {
                    return $this->show(
                        config("status.error"),
                        config("message.error"),
                        $errCode
                    );
                }
            }

            $this->classesModel->insertClasses($data);

            return $this->show(
                config("status.success"),
                config("message.success"),
                '添加成功'
            );
        } else {
            $token = Request::buildToken('__token__', 'sha1');
            return view('classes/add', $token);
        }
    }

    /**
     * 班级信息update
     */
    public function edit()
    {
        if (Request::isPost()) {
            $class_id = (int)Request::post('class_id', '');

            // 获取客户端数据
            $data['class_name'] = trim(Request::post('class_name', ''));
            $data['status'] = trim(Request::post('status', ''));
            $data['class_time'] = trim(Request::post('class_time', ''));
            $data['remarks'] = trim(Request::post('remarks', ''));

            //验证类判断
            try {
                validate(ClassesValidate::class)->scene('edit')->check($data);
            } catch (ValidateException $e) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    $e->getMessage(),
                );
            }

            $data['start_time'] = date("Y-m-d H:i:s", time());

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
        } else {
            $class_id = (int)Request::get('class_id', '');
            $data['token'] = Request::buildToken('__token__', 'sha1');
            $data['class'] = $this->classesModel->findClasses($class_id);
            return view('classes/edit', $data);
        }
    }

    /**
     * 删除班级信息
     */
    public function del()
    {
        $id = (int)Request::post('id', '');
        $class_id = (int)Request::post('class_id', '');
        if (!$id || !$class_id) {
            return $this->show(
                config("status.error"),
                config("message.error"),
                '非法请求'
            );
        }

        // 清除excel表格，班级数据
        $errFileCode = $this->classesBusiness->delFile($class_id);
        if ($errFileCode == config('status.error')) {
            return $this->show(
                config("status.error"),
                config("message.error"),
                '删除失败'
            );
        }

        $this->classesModel->delClasses($class_id);
        $this->stuModel->delStu($class_id);
        $this->workModel->delWork($class_id);
        $this->isWorkodel->delIsWork($class_id);
        $this->worksModel->delWorks($class_id);
        $this->scoreModel->delScore($class_id);

        return $this->show(
            config("status.success"),
            config("message.success"),
            '删除成功'
        );
    }

    /**
     * 导出班级信息
     */
    public function getZip()
    {
        $class_id = (int)Request::get('class_id', '');

        $this->classesBusiness->getZip($class_id);
    }
}
