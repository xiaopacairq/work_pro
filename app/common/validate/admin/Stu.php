<?php

namespace app\common\validate\admin;

use think\Validate;

class Stu extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'=>['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'stu_no' => 'require|max:10',
        'stu_pwd'  => 'require|max:20',
        'stu_name' => 'require|max:20',
        'email' => 'require|email',
        'gender' => 'require|in:0,1',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'=>'错误信息'
     *
     * @var array
     */
    protected $message = [
        'stu_no.require' => '学号不为空',
        'stu_no.max' => '学号不超过10个字符',
        'stu_pwd.require' => '密码不为空',
        'stu_pwd.max' => '密码不超过20个字符',
        'stu_name.require' => '姓名不为空',
        'stu_name.max' => '姓名不超过20个字符',
        'email.require' => '邮箱服务器不为空',
        'email.email' => '邮箱格式有误',
        'gender.require' => '性别不为空',
        'gender.in' => '性别格式有误',
    ];
    /**
     * 定义验证场景
     * 格式：'场景名'=>['规则1','规则2',...]
     *
     * @var array
     */
    protected $scene = [
        'add' => ['stu_no', 'stu_name', 'email', 'gender'],
        'edit' => ['stu_pwd', 'stu_name', 'email', 'gender'],
    ];
}