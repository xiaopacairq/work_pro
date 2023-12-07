<?php

namespace app\common\model;

use think\Model;


class AdminIp extends Model
{
    protected $table = 'admin_ip';

    /**
     * 记录登录的ip信息
     */
    public function addAdminIp($data)
    {
        $this->insert($data);
    }
}
