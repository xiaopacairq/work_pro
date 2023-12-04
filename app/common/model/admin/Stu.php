<?php

namespace app\common\model\admin;

use think\Model;
use think\facade\Db;


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
        $res = Db::table('stu')->where('class_id', $class_id)->where(function ($query) use ($where) {
            $query->whereOr($where);
        })->order('stu_no', 'asc')->paginate([
            'list_rows' => 8,
            'query' => request()->param(),
        ]);
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
     * 清空数据表
     */
    public function clearStuOrWorksOrIsWorkOrScore($class_id, $stu_no = null)
    {
        if (empty($stu_no)) {
            //清空整个班级数据
            Db::table('stu')->where('class_id', $class_id)->delete();
            Db::table('works')->where('class_id', $class_id)->delete();
            Db::table('is_work')->where('class_id', $class_id)->delete();
            Db::table('score')->where('class_id', $class_id)->delete();
        } else {
            Db::table('stu')->where(['stu_no' => $stu_no, 'class_id' => $class_id])->delete();
            Db::table('score')->where(['stu_no' => $stu_no, 'class_id' => $class_id])->delete();
            Db::table('is_work')->where(['stu_no' => $stu_no, 'class_id' => $class_id])->delete();
            Db::table('works')->where(['stu_no' => $stu_no, 'class_id' => $class_id])->delete();
        }
    }
}
