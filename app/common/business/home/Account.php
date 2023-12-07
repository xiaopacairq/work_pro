<?php

namespace app\common\business\home;

use app\common\model\Stu as StuModel;
use app\common\model\StuIp as StuIpModel;
use app\common\model\Classes as ClassesModel;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * 执行核心逻辑
 */
class Account
{
    private $stuModel = null;
    private $stuIpModel = null;
    private $classesModel = null;
    private $expTime = 60 * 60;

    public function __construct()
    {
        // 核心逻辑
        $this->stuModel = new StuModel();
        $this->stuIpModel = new StuIpModel();
        $this->classesModel = new ClassesModel();
    }

    /**
     * 检查用户登录
     */
    public function check($data)
    {
        // 查找用户
        $class = $this->classesModel->findClasses($data['class_id']);
        if ($class['status'] == 1) {
            return config("status.error");
        }

        $user = $this->stuModel->findStu($data['class_id'], $data['stu_no']);
        if ($user->isEmpty()) {
            return config("status.error");
        }

        if ($user['stu_pwd'] != $data['stu_pwd']) {
            return config("status.error");
        }

        $this->stuModel->updateStuTimeOrCount($user['id']);


        $login_token = $this->createToken($user['id'], $user['class_id'], $user['stu_no']);
        cookie('stu_login_token', $login_token);

        $this->addIp($user['class_id'], $user['stu_no'], $login_token);

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
    private function addIp($class_id, $stu_no, $login_token)
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
            'class_id' => $class_id,
            'stu_no' => $stu_no,
            'ip' => $ip,
            'lsp' => $result['result']['Isp'],
            'last_time' => date("Y-m-d H:i:s", time()),
            'city' => $result['result']['City'],
            'token' => $login_token,
        ];

        $this->stuIpModel->addStuIp($data);
    }

    /**
     * 创建 token
     * @param token过期时间 单位:秒 例子：7200=2小时
     * @return string
     */
    private function createToken($id, $class_id, $stu_no)
    {
        $nowTime = time();
        try {
            $login_token['id'] = $id; //自带参数
            $login_token['stu_no'] = $stu_no; //自带参数
            $login_token['class_id'] = $class_id; //自带参数
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
