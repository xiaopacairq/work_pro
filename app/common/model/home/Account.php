<?php

namespace app\common\model\home;

use think\Model;
use think\facade\Db;


class Account extends Model
{
    protected $table = 'stu';

    /**
     * 查找用户的信息
     */
    public function findByStu($class_id, $stu_no)
    {
        $res = $this
            ->where(['class_id' => $class_id, 'stu_no' => $stu_no])
            ->findOrEmpty();

        return $res;
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
     * 记录登录的ip信息
     */
    public function addStuIp($data)
    {
        Db::table('stu_ip')->insert($data);
    }
}