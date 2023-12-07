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
     * 获取作业文件的详情
     */
    public function findWorks($id)
    {
        $res = $this->where('id', $id)->findOrEmpty();
        return $res;
    }

    /**
     * 获取当前作业中有无入口 index 文件
     */
    public function findIndex($class_id, $stu_no, $work_id)
    {
        $res = $this->where(['class_id' => $class_id, 'stu_no' => $stu_no, 'work_id' => $work_id])
            ->where('filename', 'like', 'index.' . '%')
            ->findOrEmpty();
        return $res;
    }

    /**
     * 作业文件个数
     */
    public function getWorksCount($class_id, $stu_no, $work_id)
    {
        $res = $this->where(['class_id' => $class_id, 'work_id' => $work_id, 'stu_no' => $stu_no])->count();
        return $res;
    }

    /**
     * 检查 作业 文件是否重名
     */
    public function findWorksFilename($filename, $class_id, $stu_no, $work_id)
    {
        $res = $this->where(['class_id' => $class_id, 'filename' => $filename, 'stu_no' => $stu_no, 'work_id' => $work_id])->findOrEmpty();
        return $res;
    }

    /**
     * 获取已上传文件信息
     */
    public function getWorkFileList($class_id, $stu_no, $work_id)
    {
        $res = $this  //获取已上传的文件信息
            ->where(['class_id' => $class_id, 'stu_no' => $stu_no, 'work_id' => $work_id])
            ->select()->toArray();
        return $res;
    }

    /**
     * 添加作业文件详情
     */
    public function addWorks($data)
    {
        $this->insert($data);
    }

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

    /**
     * 删除作业
     */
    public function delWorksById($id)
    {
        $this->where('id', $id)->delete();
    }

    /**删除作业 */
    public function delWorksByWorkId($class_id, $work_id)
    {

        $this->where(['class_id' => $class_id, 'work_id' => $work_id])->delete();
    }



    /**
     * 修改 作业 文件的提交时间
     */
    public function editWorksStartTime($filename, $class_id, $stu_no, $work_id)
    {
        $this->where(['class_id' => $class_id, 'filename' => $filename, 'stu_no' => $stu_no, 'work_id' => $work_id])->update(['start_time' =>  date("Y-m-d H:i:s", time())]);
    }
}
