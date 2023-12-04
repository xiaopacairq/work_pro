<?php

namespace app\admin\controller;

use think\facade\Request;
use think\facade\View;

use think\exception\ValidateException;

use app\common\model\admin\Classes as ClassesModel;
use app\common\model\admin\Stu as StuModel;
use app\common\business\admin\Stu as StuBusiness;
use app\common\validate\admin\Stu as StuValidate;


/**
 * 后台学生管理
 */
class Stu extends Base
{
    private $classesModel = null;
    private $stuBusiness = null;
    private $stuModel = null;

    public function __construct()
    {
        // 核心逻辑
        $this->classesModel = new ClassesModel();
        $this->stuBusiness = new StuBusiness();
        $this->stuModel = new StuModel();
        $this->initialize();
    }

    /**
     * 学生信息主页
     */
    public function index()
    {
        $class_id = (int)Request::get('class_id', '');

        $data['class'] = $this->classesModel->findClasses($class_id)->toArray();
        $data['admin'] = $this->uname;
        $data['class']['title'] = '学生管理';

        // 根据条件获取数据
        $data['search'] = trim(Request::get('search', ''));  //搜索内容
        $data['page'] = Request::get('page', '1');  //页数

        $where = [];
        if (!empty($data['search'])) {
            $where[] = ['stu_no', 'like', '%' . $data['search'] . '%'];
            $where[] = ['stu_name', 'like', '%' . $data['search'] . '%'];
            ($data['search'] == '男') ? $where[] = ['gender', '=', 0] : '';
            ($data['search'] == '女') ? $where[] = ['gender', '=', 1] : '';
        }

        $data['stu'] = $this->stuModel->getStuList($class_id, $where);
        $data['page'] = $this->stuModel->getStuList($class_id, $where)->render();



        // 更新学生数据表与excel同步
        $this->stuBusiness->createExcel($class_id);


        View::engine()->layout('layout');
        return View::fetch('stu/index', $data);
    }

    /**
     * 学生导入
     */
    public function upfileStu()
    {
        if (Request::isPost()) {
            $class_id = (int)Request::param('class_id', '');

            // 获取文件上传信息
            $file = Request::file('file');

            $errCode =  $this->stuBusiness->scanExcel($class_id, $file);
            if ($errCode != config('status.success')) {
                if ($errCode == config('status.upfile_excel_ext_err')) {
                    return $this->show(
                        config("status.upfile_excel_ext_err"),
                        config("message.upfile_excel_ext_err"),
                        '上传excel后缀错误'
                    );
                }
                if ($errCode == config('status.upfile_excel_no_exist')) {
                    return $this->show(
                        config("status.upfile_excel_no_exist"),
                        config("message.upfile_excel_no_exist"),
                        '上传excel为空'
                    );
                }
                if ($errCode == config('status.upfile_excel_class_err')) {
                    return $this->show(
                        config("status.upfile_excel_class_err"),
                        config("message.upfile_excel_class_err"),
                        '上传excel班级编号错误'
                    );
                }
                if ($errCode == config('status.upfile_excel_context_err')) {
                    return $this->show(
                        config("status.upfile_excel_context_err"),
                        config("message.upfile_excel_context_err"),
                        '上传excel内容格式有误'
                    );
                }
            }

            return $this->show(
                config("status.success"),
                config("message.success"),
                '更新成功'
            );
        } else {
            $data['class_id'] = (int)Request::get('class_id', '');
            return View::fetch('stu/upfile_stu', $data);
        }
    }

    /**
     * 学生删除
     */
    public function del()
    {
        //删除学生的stu、score、is_work、works
        $class_id = (int)Request::post('class_id', '');  //获取班级代码
        $is_clear_all = (int)Request::post('is_clear_all', 0);  //获取到清空权限，则删除整个数据表里的数据

        $stu_no = Request::post('stu_no', '');  //获取到学号

        if (empty($class_id)) { //如果没有get参数，则返回
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                '非法请求'
            );
        }

        $errCode =  $this->stuBusiness->delStu($class_id, $stu_no, $is_clear_all);
        if ($errCode != config('status.success')) {
            if ($errCode == config('status.error')) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '文件删除失败'
                );
            }
        }

        return $this->show(
            config("status.success"),
            config("message.success"),
            '删除成功'
        );
    }

    /**
     * 学生单独添加
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

            $class_id = (int)Request::post('class_id', '');
            $data['class_id'] = (int)Request::post('class_id', '');
            $data['stu_no'] = (int)Request::post('stu_no', '');
            $data['stu_name'] = trim(Request::post('stu_name', ''));
            $data['email'] = trim(Request::post('email', ''));
            $data['gender'] = (int)Request::post('gender', '');

            //验证类判断
            try {
                validate(StuValidate::class)->scene('add')->check($data);
            } catch (ValidateException $e) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    $e->getMessage(),
                );
            }

            $isStu = $this->stuModel->findStu($data['class_id'], $data['stu_no']);
            if (!$isStu->isEmpty()) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '班级下学号已存在'
                );
            }

            $this->stuBusiness->addStu($data, $class_id);


            return $this->show(
                config("status.success"),
                config("message.success"),
                '添加成功'
            );
        } else {
            $data['token'] = Request::buildToken('__token__', 'sha1');
            $data['class_id'] = (int)Request::get('class_id', '');
            return View::fetch('stu/add', $data);
        }
    }

    /**
     * 学生修改
     */
    public function edit()
    {
        if (Request::isPost()) {
            if (false === Request::checkToken('__token__')) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    '请勿重复提交'
                );
            }
            $stu_no = (int)Request::post('stu_no', ''); //学号默认不能修改
            $class_id = (int)Request::post('class_id', '');
            $data['stu_name'] = trim(Request::post('stu_name', ''));
            $data['stu_pwd'] = trim(Request::post('stu_pwd', ''));
            $data['email'] = trim(Request::post('email', ''));
            $data['gender'] = (int)Request::post('gender', '');

            //验证类判断
            try {
                validate(StuValidate::class)->scene('edit')->check($data);
            } catch (ValidateException $e) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    $e->getMessage(),
                );
            }

            $this->stuBusiness->editStu($data, $class_id, $stu_no);

            return $this->show(
                config("status.success"),
                config("message.success"),
                '修改成功'
            );
        } else {
            $data['token'] = Request::buildToken('__token__', 'sha1');
            $data['stu_no'] =  (int)Request::get('stu_no', '');
            $data['class_id'] = (int)Request::get('class_id', '');
            $data['stu'] = $this->stuModel->findStu($data['class_id'], $data['stu_no'])->toArray();
            return View::fetch('stu/edit', $data);
        }
    }


    /**
     * 学生导出
     */
    public function getZip()
    {
        $class_id = (int)Request::get('class_id', '');
        $this->stuBusiness->getZip($class_id);
    }

    /**
     * 密码邮件推送服务
     */
    public function sendEmailStu()
    {
        if (Request::isPost()) {
            $data['class_id'] = (int)Request::post('class_id', '');
            $data['class_name'] = Request::post('class_name', '');
            $data['stu_no'] = (int)Request::post('stu_no', ''); // 单发标识
            $data['admin'] = $this->uname;

            $is_all = (int)Request::post('is_all', ''); //群发标识

            $errCode = $this->stuBusiness->sendEmail($data, $is_all);

            if ($errCode != config('status.success')) {
                return $this->show(
                    config("status.error"),
                    config("message.error"),
                    $errCode
                );
            }

            return $this->show(
                config("status.success"),
                config("message.success"),
                '邮件发送成功'
            );
        } else {
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                '非法请求'
            );
        }
    }
}