<?php

namespace app\admin\controller;

use app\BaseController;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * 预加载
 */
class Base extends BaseController
{
    public $uname_id; //登入用户id
    public $uname; //登入用户

    // 初始化：未登录的用户不允许进入
    public function initialize()
    {
        $login_token = cookie('login_token');
        $decoded = (array)JWT::decode($login_token, new Key(config('key.token_key'), "HS256"));
        $this->uname_id = $decoded['uname_id'];
        $this->uname = $decoded['uname'];
    }

    /**
     * 退出登录
     */
    public function quit()
    {
        cookie('login_token', null);
    }


}