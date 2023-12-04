<?php

namespace app\common\validate\admin;

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
        'uname'  => 'require|max:20',
        'pwd'   => 'require|max:20',
        'captcha' => 'require|captcha',
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
        'captcha.captcha' => '验证码错误'
    ];
    /**
     * 定义验证场景
     * 格式：'场景名'=>['规则1','规则2',...]
     *
     * @var array
     */
    protected $scene = [
        'login'=>['uname','pwd','captcha']
    ];
}
