<?php

namespace app\home\controller;

use app\BaseController;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * 预加载
 */
class Base extends BaseController
{
    public $id; //登入学生id
    public $class_id; //登入学生班级
    public $stu_no; //登入学生学号

    // 初始化：未登录的用户不允许进入
    public function initialize()
    {
        $login_token = cookie('stu_login_token');
        $decoded = (array)JWT::decode($login_token, new Key(config('key.token_key'), "HS256"));
        $this->id = $decoded['id'];
        $this->class_id = $decoded['class_id'];
        $this->stu_no = $decoded['stu_no'];
    }

    /**
     * 退出登录
     */
    public function quit()
    {
        cookie('stu_login_token', null);
    }
}
