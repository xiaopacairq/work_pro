<?php

namespace app\home\middleware;

use app\common\business\home\Account as AccountBusiness;

/**
 * 权限校验类
 */

class Auth
{
    private $accountBusiness = null;

    public function __construct()
    {
        // 核心逻辑
        $this->accountBusiness = new AccountBusiness();
    }

    public function handle($request, \Closure $next)
    {
        $login_token = cookie('stu_login_token');

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
