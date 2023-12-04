<?php

namespace app\common\validate\admin;

use think\Validate;

class AdminEdit extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'=>['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'pwd'  => 'require|max:20',
        'email' => 'require|email',
        'email_system' => 'require',
        'check_code' => 'require',
        'server_ip' => 'require|max:50',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'=>'错误信息'
     *
     * @var array
     */
    protected $message = [
        'pwd.require' => '密码不为空',
        'pwd.max' => '密码不超过20个字符',
        'email.require' => '邮箱不为空',
        'email.email' => '邮箱格式错误',
        'email_system.require' => '邮箱服务器不为空',
        'check_code.require' => 'key不能为空',
        'server_ip.require' => '学生网站入口不为空',
        'server_ip.max' => '学生网站超过50字',

    ];
    /**
     * 定义验证场景
     * 格式：'场景名'=>['规则1','规则2',...]
     *
     * @var array
     */
    protected $scene = [
        'edit' => ['pwd', 'email']
    ];
}