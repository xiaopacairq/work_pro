<?php

namespace app\common\model;

use think\Model;

class StuIp extends Model
{
    protected $table = 'stu_ip';


    /**
     * 记录登录的ip信息
     */
    public function addStuIp($data)
    {
        $this->insert($data);
    }
}
