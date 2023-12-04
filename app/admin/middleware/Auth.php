<?php

namespace app\admin\middleware;

use app\common\business\admin\Account as AccountBusiness;

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
        $login_token = cookie('login_token');

        $errCode = $this->accountBusiness->checkToken($login_token);
        if ($errCode == config('status.login_token_err')) {
            cookie('login_token', null);
        }

        $isLogin = (!preg_match('/login/', request()->pathinfo()) && !preg_match('/check/', request()->pathinfo()) && !preg_match('/verify/', request()->pathinfo()));


        if (empty($login_token) && $isLogin) {
            if (request()->isAjax()) {
                return json(['status' => '10004', 'message' => '执行失败', 'result' => "token不合法，退出登录"]);
            }
            return redirect('/teacher/login');
        }

        return $next($request);
    }
}