<?php

namespace app\home\middleware;

use app\common\business\home\Account as AccountBusiness;
use app\common\model\Classes as ClassesModel;

/**
 * 权限校验类
 */

class Auth
{
    private $accountBusiness = null;
    private $classesModel = null;

    public function __construct()
    {
        // 核心逻辑
        $this->classesModel = new ClassesModel();
        $this->accountBusiness = new AccountBusiness();
    }

    public function handle($request, \Closure $next)
    {
        $login_token = cookie('stu_login_token');

        // 查找用户
        $class = $this->classesModel->findClasses($request->param('class_id'));
        if (!$class->isEmpty()) {
            if ($class['status'] == 1) {
                cookie('stu_login_token', null);
            }
        }

        $errCode = $this->accountBusiness->checkToken($login_token);
        if ($errCode == config('status.login_token_err')) {
            cookie('stu_login_token', null);
        }

        $isLogin = (!preg_match('/login/', request()->pathinfo()) && !preg_match('/check/', request()->pathinfo()) && !preg_match('/verify/', request()->pathinfo()));


        if (empty($login_token) && $isLogin) {
            if (request()->isAjax()) {
                return json(['status' => '10004', 'message' => '执行失败', 'result' => "token不合法，退出登录"]);
            }
            return redirect('/student/login');
        }

        return $next($request);
    }
}
