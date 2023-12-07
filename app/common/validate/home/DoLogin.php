<?php

namespace app\common\validate\home;

use think\Validate;

class DoLogin extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'=>['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'class_id'  => 'require|max:20',
        'stu_no'   => 'require|max:20',
        'stu_pwd'   => 'require|max:20',
        'captcha' => 'require|captcha',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'=>'错误信息'
     *
     * @var array
     */
    protected $message = [
        'class_id.require' => '班级代码不为空',
        'class_id.max' => '班级代码不超过20个字符',
        'stu_no.require' => '学号不为空',
        'stu_no.max' => '学号不超过20个字符',
        'stu_pwd.require' => '密码不为空',
        'stu_pwd.max' => '密码不超过20个字符',
        'captcha.require' => '验证码不为空',
        'captcha.captcha' => '验证码错误'
    ];
    /**
     * 定义验证场景
     * 格式：'场景名'=>['规则1','规则2',...]
     *
     * @var array
     */
    protected $scene = [];
}
