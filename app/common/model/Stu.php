<?php

namespace app\common\model;

use think\Model;

class Stu extends Model
{
    protected $table = 'stu';

    /**
     * 获取单独的学生信息
     */
    public function findStu($class_id, $stu_no)
    {
        $res = $this->where(['class_id' => $class_id, 'stu_no' => $stu_no])->findOrEmpty();
        return $res;
    }

    /**
     * 获取学生的信息，以分页方式传入前端
     */
    public function getStuList($class_id, $where)
    {
        $res = $this->where('class_id', $class_id)->where(function ($query) use ($where) {
            $query->whereOr($where);
        })->order('stu_no', 'asc')->paginate([
            'list_rows' => 8,
            'query' => request()->param(),
        ]);
        return $res;
    }

    /**
     * 获取所有学生的信息
     */
    public function getStuListByClassId($class_id)
    {
        //获取所有的学生
        $res = $this->where('class_id', $class_id)->order('stu_no', 'asc')->select()->toArray();
        return $res;
    }

    /**
     * 获取学生的信息，导入到excel中
     */
    public function getStuListToExcel($class_id)
    {
        $res = $this->where('class_id', $class_id)->order('stu_no', 'asc')->select()->toArray();
        return $res;
    }


    /**
     * 插入学生信息
     */
    public function addStu($data, $is_all = false)
    {
        if ($is_all) {
            $this->saveAll($data);
        } else {
            $this->insert($data);
        }
    }

    /**
     * 修改学生信息
     */
    public function editStu($data, $class_id, $stu_no)
    {
        $this->where(['class_id' => $class_id, 'stu_no' => $stu_no])->update($data);
    }

    /**
     * 删除学生数据
     */
    public function delStu($class_id, $stu_no = null)
    {
        if (empty($stu_no)) {
            $this->where('class_id', $class_id)->delete();
        } else {
            $this->where(['stu_no' => $stu_no, 'class_id' => $class_id])->delete();
        }
    }

    /**
     * 更新登录时间和次数
     */
    public function updateStuTimeOrCount($id)
    {
        $this->where('id', $id)->update(['last_time' => date("Y-m-d H:i:s", time())]);
        $this->where('id', $id)->inc('count', 1)->update();
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
