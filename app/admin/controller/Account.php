<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\validate\admin\DoLogin;
use app\common\business\admin\Account as AccountBusiness;

use think\captcha\facade\Captcha;
use think\facade\Request;

use think\exception\ValidateException;

/**
 * 登录校验
 */

class Account extends BaseController
{

    private $accountBusiness = null;

    public function __construct()
    {
        // 核心逻辑
        $this->accountBusiness = new AccountBusiness();
    }

    /**
     * 登录视图
     */
    public function index()
    {
        $this->isLogin();
        return view('/account/login');
    }

    /**
     * 注册验证码
     */
    public function verify()
    {
        return Captcha::create();
    }

    /**
     * 登录校验
     */
    public function doLogin()
    {
        // 获取登录信息
        $data['uname'] = trim(Request::post('uname', ''));
        $data['pwd'] = Request::post('pwd', '');
        $data['captcha'] = trim(Request::post('captcha', ''));

        //验证类判断
        try {
            validate(Dologin::class)->scene('login')->check($data);
        } catch (ValidateException $e) {
            return $this->show(
                config("status.error"),
                config("message.error"),
                $e->getMessage()
            );
        }

        // 登录校验
        $errcode = $this->accountBusiness->check($data);

        if ($errcode != config("status.success")) {
            return $this->show(
                config("status.error"),
                config("message.error"),
                '账号或密码有误，请重新输入'
            );
        }

        return $this->show(
            config("status.success"),
            config("message.success"),
            '登录成功'
        );
    }

    /**
     * 登录页判断
     * 已经登录，不再跳转到登录页
     */
    private function isLogin()
    {
        $login_token = cookie('login_token');

        $errCode = $this->accountBusiness->checkToken($login_token);

        // 若token失效，这清空token
        if ($errCode != config("status.success")) {
            if ($errCode == config('status.login_token_err')) {
                $login_token = cookie('login_token', null);
            }
        }

        // token为空
        if (!empty($login_token)) {
            return header('location:/teacher/welcome');
        }
    }
}
