<?php

namespace app\common\model\admin;

use think\Model;
use think\facade\Db;


class Account extends Model
{
    protected $table = 'admin';

    /**
     * 查找用户的信息
     */
    public function findByAdmin($user)
    {
        // try {
        //     $res = Db::table('admin')->field('id,uname,pwd')->where('uname',$user)->findOrEmpty();
        // } catch (think\db\exception\PDOException $e) {
        //     return $this->show(
        //         config("status.error"),
        //         config("message.error"),
        //         $e->getMessage()
        //     );
        // }

        $res = $this->where('uname', $user)->findOrEmpty();

        return $res;
    }

    /**
     * 更新登录时间和次数
     */
    public function updateAdminTimeOrCount($id)
    {
        Db::table('admin')->where('id', $id)->update(['last_time' => date("Y-m-d H:i:s", time())]);
        Db::name('admin')->where('id', $id)->inc('count', 1)->update();
    }

    /**
     * 记录登录的ip信息
     */
    public function addAdminIp($data)
    {
        Db::table('admin_ip')->insert($data);
    }
}