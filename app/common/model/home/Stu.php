<?php

namespace app\common\model\home;

use think\Model;
use think\facade\Db;


class Stu extends Model
{
    protected $table = 'stu';

    /**
     * 获取学生信息
     */
    public function getStuList($class_id)
    {
        $res = $this->where('class_id', $class_id)->select()->toArray();
        return $res;
    }

    /**
     * 获取学生的信息，
     */
    public function getStuCount($class_id)
    {
        $res = $this->where('class_id', $class_id)->count();
        return $res;
    }
}
