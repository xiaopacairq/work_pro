<?php

namespace app\common\model;

use think\Model;
use think\facade\Db;

class Work extends Model
{
    protected $table = 'work';


    /**
     * 判断作业id是否已存在
     */
    public function findWork($class_id, $work_id)
    {
        $res = $this->where(['class_id' => $class_id, 'work_id' => $work_id])->findOrEmpty();
        return $res;
    }

    /**
     * 获取当前作业
     */
    public function findWorkToStu($class_id, $work_id)
    {
        $res = $this->where(['class_id' => $class_id, 'work_id' => $work_id, 'status' => 0])->order('work_id', 'desc')->findOrEmpty();
        return $res;
    }

    /**
     * 获取作业表的信息
     */
    public function getWorkList($class_id)
    {
        $res = $this->where('class_id', $class_id)->select()->toArray();
        return $res;
    }

    /**
     * 获取作业信息到学生，状态不为0不展示
     */
    public function getWorkListToStu($class_id)
    {
        $res = $this->where(['class_id' => $class_id, 'status' => 0])->order('work_id', 'desc')->select()->toArray();
        return $res;
    }

    /**
     * 获取所有作业的信息
     */
    public function getWorkStatusList($class_id)
    {
        //获取所有的作业
        $res = Db::table('work')->where(['class_id' => $class_id, 'status' => 0])->select()->toArray();
        return $res;
    }
    /**
     * 添加作业
     */
    public function addWork($data)
    {
        $this->insert($data);
    }

    /**
     * 修改作业
     */
    public function editWork($class_id, $work_id, $data)
    {
        $this->where(['class_id' => $class_id, 'work_id' => $work_id])->update($data);
    }

    /**删除作业 */
    public function delWorkByWorkId($class_id, $work_id)
    {

        $this->where(['class_id' => $class_id, 'work_id' => $work_id])->delete();
    }

    /**
     * 删除布置作业数据
     */
    public function delWork($class_id)
    {
        $this->where('class_id', $class_id)->delete();
    }
}
