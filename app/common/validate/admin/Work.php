<?php

namespace app\common\validate\admin;

use think\Validate;

class Work extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'=>['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'class_id' => 'require',
        'work_id' => 'require|max:10',
        'work_remarks'  => 'require|max:200',
        'status' => 'require|in:0,1',
        'work_last_time' => 'require'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'=>'错误信息'
     *
     * @var array
     */
    protected $message = [
        'class_id.require' => '班级编号为空',
        'work_id.require' => '作业号不为空',
        'work_id.max' => '作业号不超过10个字符',
        'work_remarks.require' => '作业说明不为空',
        'work_remarks.max' => '作业说明不超过200个字符',
        'status.require' => '状态码不为空',
        'status.in' => '状态码非法',
        'work_last_time.require' => '截止时间不为空',
    ];
    /**
     * 定义验证场景
     * 格式：'场景名'=>['规则1','规则2',...]
     *
     * @var array
     */
    protected $scene = [
        'add' => ['class_id', 'work_id', 'work_remarks', 'status', 'work_last_time'],
        'edit' => ['work_remarks', 'status', 'work_last_time'],
    ];
}