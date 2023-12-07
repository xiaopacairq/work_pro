<?php

namespace app\common\business\admin;

use app\common\model\Admin as AdminModel;
use app\common\model\AdminIp as AdminIpModel;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * 执行核心逻辑
 */
class Account
{
    private $adminModel = null;
    private $adminIpModel = null;
    private $expTime = 60 * 60;

    public function __construct()
    {
        // 核心逻辑
        $this->adminModel = new AdminModel();
        $this->adminIpModel = new AdminIpModel();
    }

    /**
     * 检查用户登录
     */
    public function check($data)
    {
        // 查找用户
        $user = $this->adminModel->findAdminByUname($data['uname']);
        if ($user->isEmpty()) {
            return config("status.error");
        }

        // 密码错误
        if ($user['pwd'] != $data['pwd']) {
            return config("status.error");
        }

        $this->adminModel->updateAdminTimeOrCount($user['id']);

        $login_token = $this->createToken($user['id'], $user['uname']);

        if ($login_token == config('status.error')) {
            return config('status.error');
        }

        cookie('admin_login_token', $login_token);

        $this->addIp($user['id'], $login_token);

        return config("status.success");
    }


    /**
     * 验证login_token
     */
    public function checkToken($login_token)
    {
        if (!isset($login_token) || empty($login_token)) {
            return config('status.login_token_err');
        }

        $decoded = (array)JWT::decode($login_token, new Key(config('key.token_key'), "HS256"));
        if ($decoded['iss'] != 'meizhou') {
            return config('status.login_token_err');
        }
        if ($decoded['exp'] < time()) {
            return config('status.login_token_err');
        }

        return config('status.success');
    }

    /**
     * 记录登录ip
     */
    private function addIp($uid, $login_token)
    {
        $url = config('api.find_ip.url');
        $ip = request()->ip();
        $key = config('api.find_ip.code');

        $params = [
            "ip" => $ip, //需要查询的IP地址或域名
            "key" => $key, //应用APPKEY(应用详细页查询)
        ];

        $paramstring = http_build_query($params);
        $content = juheHttpRequest($url, $paramstring, 1);
        $result = json_decode($content, true);

        if ($result['error_code'] != 0) {
            return config("status.error");
        }
        $data = [
            'uid' => $uid,
            'ip' => $ip,
            'lsp' => $result['result']['Isp'],
            'last_time' => date("Y-m-d H:i:s", time()),
            'city' => $result['result']['City'],
            'token' => $login_token,
        ];

        $this->adminIpModel->addAdminIp($data);
    }

    /**
     * 创建 token
     * @param token过期时间 单位:秒 例子：7200=2小时
     * @return string
     */
    private function createToken($id, $uname)
    {
        $nowTime = time();
        try {
            $login_token['uname'] = $uname; //自带参数
            $login_token['uname_id'] = $id; //自带参数
            $login_token['iss'] = 'meizhou'; //签发者 可选
            $login_token['iat'] = $nowTime; //签发时间
            $login_token['exp'] = $nowTime + $this->expTime; //token过期时间,这里设置2个小时
            $login_token = JWT::encode($login_token, config('key.token_key'), "HS256");
            return $login_token;
        } catch (\Firebase\JWT\ExpiredException $e) { //签名不正确
            return config('status.error');
        } catch (\Exception $e) { //其他错误
            return config('status.error');
        }
    }
}
