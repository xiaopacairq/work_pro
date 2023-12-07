<?php

namespace app\common\model\home;

use think\Model;
use think\facade\Db;


class Classes extends Model
{
    /**
     * 获取班级信息
     */
    public function findClass($class_id)
    {
        $res = Db::table('classes')->where('class_id', $class_id)->find();
        return $res;
    }
    /**
     * 获取学生信息
     */
    public function findStu($class_id, $stu_no)
    {
        $res = Db::table('stu')->where(['class_id' => $class_id, 'stu_no' => $stu_no])->find();
        return $res;
    }
}