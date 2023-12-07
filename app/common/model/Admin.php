<?php

namespace app\common\model;

use think\Model;


class Admin extends Model
{
    protected $table = 'admin';

    /**
     * 查找用户的信息
     */
    public function findAdminByUname($user)
    {
        $res = $this->where('uname', $user)->findOrEmpty();
        return $res;
    }

    /**
     * 查找管理员的个人信息
     */
    public function findAdmin($id)
    {
        return $this->where('id', $id)->findOrEmpty();
    }

    /**
     * 更新管理员信息
     */
    public function editAdmin($id, $data)
    {
        $this->where('id', $id)->update($data);
    }

    /**
     * 更新登录时间和次数
     */
    public function updateAdminTimeOrCount($id)
    {
        $this->where('id', $id)->update(['last_time' => date("Y-m-d H:i:s", time())]);
        $this->where('id', $id)->inc('count', 1)->update();
    }
}
