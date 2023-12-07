<?php

namespace app\common\validate\admin;

use think\Validate;

class Admin extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'=>['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'uname'  => 'require|max:20',
        'pwd'   => 'require|max:20',
        'captcha' => 'require|captcha',

        'email' => 'require|email',
        'email_system' => 'require|max:50',
        'check_code' => 'require|max:50',
        'server_ip' => 'require|max:50',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'=>'错误信息'
     *
     * @var array
     */
    protected $message = [
        'uname.require' => '用户名不为空',
        'uname.max' => '用户名不超过20个字符',
        'pwd.require' => '密码不为空',
        'pwd.max' => '密码不超过20个字符',
        'captcha.require' => '验证码不为空',
        'captcha.captcha' => '验证码错误',

        'email.require' => '邮箱不为空',
        'email.email' => '邮箱格式错误',
        'email_system.require' => '邮箱服务器不为空',
        'email_system.max' => '邮箱服务器不超过50个字符',
        'check_code.require' => 'key不能为空',
        'check_code.max' => '邮箱秘钥不超过50个字符',
        'server_ip.require' => '学生网站入口不为空',
        'server_ip.max' => '学生网站入口不超过50个字符',
    ];
    /**
     * 定义验证场景
     * 格式：'场景名'=>['规则1','规则2',...]
     *
     * @var array
     */
    protected $scene = [
        'login' => ['uname', 'pwd', 'captcha'],
        'edit' => ['pwd', 'email', 'email_system', 'check_code', 'server_ip']
    ];
}
