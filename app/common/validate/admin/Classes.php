<?php

namespace app\common\validate\admin;

use think\Validate;

class Classes extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'=>['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'class_id'  => 'integer|max:10',
        'class_name' => 'require|max:30',
        'status' => 'in:0,1',
        'class_time' => 'require|max:30',
        'remarks' => 'require|max:100',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'=>'错误信息'
     *
     * @var array
     */
    protected $message = [
        'class_id.integer' => '班级编号限制纯数字',
        'class_id.max' => '班级编号超过10位',
        'class_name.require' => '班级名称不能为空',
        'class_name.max' => '班级名称超过30字',
        'status.in' => '状态码错误',
        'class_time.require' => '时间备注不能为空',
        'class_time.max' => '时间备注超过30字',
        'remarks.require' => '备注不为空',
        'remarks.max' => '备注超过100字',
    ];
    /**
     * 定义验证场景
     * 格式：'场景名'=>['规则1','规则2',...]
     *
     * @var array
     */
    protected $scene = [
        'edit' => ['class_name', 'status', 'class_time', 'remarks'],
        'home_edit' => ['class_name', 'class_time', 'remarks'],
    ];
}