<?php

namespace app\common\model\home;

use think\Model;
use think\facade\Db;


class Work extends Model
{
    protected $table = 'work';

    /**
     * 获取作业信息
     */
    public function getWorkList($class_id)
    {
        $res = $this->where(['class_id' => $class_id, 'status' => 0])->order('work_id', 'desc')->select()->toArray();
        return $res;
    }

    /**
     * 获取当前作业
     */
    public function findWork($class_id, $work_id)
    {
        $res = $this->where(['class_id' => $class_id, 'work_id' => $work_id, 'status' => 0])->order('work_id', 'desc')->findOrEmpty();
        return $res;
    }

    /**
     * 获取作业中间表的数据
     */
    public function getIsWorkStu($class_id, $stu_no, $work_id)
    {
        $res = Db::table('is_work')
            ->where(['class_id' => $class_id, 'stu_no' => $stu_no, 'work_id' => $work_id])
            ->find();

        return $res;
    }

    /**
     * 插入is_work中间表数据
     */
    public function addIsWork($class_id, $stu_no, $work_id)
    {
        Db::table('is_work')
            ->insert([
                'class_id' => $class_id,
                'work_id' => $work_id,
                'stu_no' => $stu_no,
                'is_true' => '0',
                'last_time' => date("Y-m-d H:i", time())
            ]);
    }

    /**
     * 获取已上传文件信息
     */
    public function getWorkFileList($class_id, $stu_no, $work_id)
    {
        $res = Db::table('works')  //获取已上传的文件信息
            ->where(['class_id' => $class_id, 'stu_no' => $stu_no, 'work_id' => $work_id])
            ->select()->toArray();
        return $res;
    }

    /**
     * 获取当前作业中有无入口 index 文件
     */
    public function findIndex($class_id, $stu_no, $work_id)
    {
        $res = Db::table('works')
            ->where(['class_id' => $class_id, 'stu_no' => $stu_no, 'work_id' => $work_id])
            ->where('filename', 'like', 'index.' . '%')
            ->find();
        return $res;
    }

    /**
     * 修改 isWork 数据表 学生提交作业的状态
     */
    public function editIsWorkStatus($class_id, $stu_no, $work_id, $data)
    {
        Db::table('is_work')->where(['class_id' => $class_id, 'stu_no' => $stu_no, 'work_id' => $work_id])->update($data);
    }

    /**
     * 作业文件个数
     */
    public function getWorksCount($class_id, $stu_no, $work_id)
    {
        $res = Db::table('works')->where(['class_id' => $class_id, 'work_id' => $work_id, 'stu_no' => $stu_no])->count();
        return $res;
    }

    /**
     * 检查 作业 文件是否重名
     */
    public function findWorksFilename($filename, $class_id, $stu_no, $work_id)
    {
        $res = Db::table('works')->where(['class_id' => $class_id, 'filename' => $filename, 'stu_no' => $stu_no, 'work_id' => $work_id])->find();
        return $res;
    }

    /**
     * 修改 作业 文件的提交时间
     */
    public function editWorksStartTime($filename, $class_id, $stu_no, $work_id)
    {
        Db::table('works')->where(['class_id' => $class_id, 'filename' => $filename, 'stu_no' => $stu_no, 'work_id' => $work_id])->update(['start_time' =>  date("Y-m-d H:i:s", time())]);
    }

    /**
     * 添加作业文件详情
     */
    public function addWorks($data)
    {
        Db::table('works')->insert($data);
    }

    /**
     * 获取作业文件的详情
     */
    public function findWorks($id)
    {
        $res = Db::table('works')->where('id', $id)->find();
        return $res;
    }

    /**
     * 删除作业
     */
    public function delWorks($id)
    {
        Db::table('works')->where('id', $id)->delete();
    }

    /**
     * 获取已提交作业的学生
     */
    public function getStuIsTrueCount($class_id, $work_id)
    {
        $res = Db::table('is_work')
            ->where(['class_id' => $class_id, 'work_id' => $work_id, 'is_true' => 1])->count();;
        return $res;
    }
}
