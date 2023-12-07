<?php

namespace app\common\model;

use think\Model;

/**
 * 作业文件存储表
 */
class Works extends Model
{
    protected $table = 'works';

    /**
     * 删除布置作业文件数据
     */
    public function delWorks($class_id, $stu_no = null)
    {
        if (empty($stu_no)) {
            $this->where('class_id', $class_id)->delete();
        } else {
            $this->where(['stu_no' => $stu_no, 'class_id' => $class_id])->delete();
        }
    }

    /**删除作业 */
    public function delWorksByWorkId($class_id, $work_id)
    {

        $this->where(['class_id' => $class_id, 'work_id' => $work_id])->delete();
    }
}