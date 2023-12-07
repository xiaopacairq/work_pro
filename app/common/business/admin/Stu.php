<?php

namespace app\common\business\admin;

use file\File;
use file\Zip1;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory; //用于载入已有的xlsx文件
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use app\common\model\Admin as AdminModel;
use app\common\model\Stu as StuModel;
use app\common\model\IsWork as IsWorkModel;
use app\common\model\Work as WorkModel;
use app\common\model\Works as WorksModel;
use app\common\model\Score as ScoreModel;



/**
 * 执行核心逻辑
 */
class Stu
{
    private $adminModel = null;
    private $stuModel = null;
    private $isWorkodel = null;
    private $workModel = null;
    private $worksModel = null;
    private $scoreModel = null;

    private $file = null;
    private $zip1 = null;

    // private $zip = null;

    public function __construct()
    {
        // 核心逻辑
        $this->adminModel = new AdminModel();
        $this->stuModel = new StuModel();
        $this->isWorkodel = new IsWorkModel();
        $this->workModel = new WorkModel();
        $this->worksModel = new WorksModel();
        $this->scoreModel = new ScoreModel();

        $this->file = new File();
        $this->zip1 = new Zip1();

        // $this->zip = new Zip();
    }

    /**
     * 添加学生信息核心类
     */
    public function addStu($data, $class_id)
    {
        // 密码随机生成8位
        $characters = '1234567890abcdefghijklmnopqrstuvwxyz';
        $data['stu_pwd'] = '';
        for ($i = 0; $i < 8; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $data['stu_pwd'] .= $characters[$index];
        }
        $data['add_time'] = date('Y-m-d H:i:s', time());
        $data['last_time'] = date("Y-m-d H:i:s", time());

        //添加学生
        $this->stuModel->addStu($data);

        // 清空 excel 文件
        $errCode =  $this->clearExcel($class_id);
        if ($errCode !=  config('status.success')) {
            if ($errCode == config('status.error')) {
                return config('status.error');
            } else {
                return $errCode;
            }
        }

        // 创建新的stu_data.xlsx文件
        $errCode = $this->createExcel($class_id);
        if ($errCode !=  config('status.success')) {
            if ($errCode == config('status.error')) {
                return config('status.error');
            } else {
                return $errCode;
            }
        }
        return config('status.success');
    }

    /**
     * 修改学生信息类
     */
    public function editStu($data, $class_id, $stu_no)
    {
        //修改学生
        $this->stuModel->editStu($data, $class_id, $stu_no);

        // 清空 excel 文件
        $errCode =  $this->clearExcel($class_id);
        if ($errCode !=  config('status.success')) {
            if ($errCode == config('status.error')) {
                return config('status.error');
            } else {
                return $errCode;
            }
        }

        // 创建新的stu_data.xlsx文件
        $errCode = $this->createExcel($class_id);
        if ($errCode !=  config('status.success')) {
            if ($errCode == config('status.error')) {
                return config('status.error');
            } else {
                return $errCode;
            }
        }

        return config('status.success');
    }

    /**
     * 创建新的学生 Excel 文件
     * 内置查询 MySQL 学生数据表，
     * 可保持 MySQL 和 Excel 数据表同步
     */
    public function createExcel($class_id, $data_stu = [])
    {
        $errCode =  $this->clearExcel($class_id);
        if ($errCode == config('status.error')) {
            return config('status.error');
        }
        if (!$data_stu) {
            $data_stu =  $this->stuModel->getStuListToExcel($class_id);
        }
        try {
            // 创建新的stu_data.xlsx文件
            $spreadsheet_stu_data = new Spreadsheet();
            $spreadsheet_stu_data->getActiveSheet()->mergeCells('A1:D1');
            $spreadsheet_stu_data->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $spreadsheet_stu_data->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $spreadsheet_stu_data->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $spreadsheet_stu_data->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $spreadsheet_stu_data->getActiveSheet()->getCell('A1')->setValue($class_id);
            $spreadsheet_stu_data->getActiveSheet()->getCell('A2')->setValue('电子邮箱');
            $spreadsheet_stu_data->getActiveSheet()->getCell('B2')->setValue('学号');
            $spreadsheet_stu_data->getActiveSheet()->getCell('C2')->setValue('姓名');
            $spreadsheet_stu_data->getActiveSheet()->getCell('D2')->setValue('性别');
            $worksheet_stu_data = $spreadsheet_stu_data->getActiveSheet(); //读取excel文件
            $worksheet_stu_data->getCell('A1')->setValue($class_id);
            $worksheet_stu_data->getCell('A2')->setValue('电子邮箱');
            $worksheet_stu_data->getCell('B2')->setValue('学号');
            $worksheet_stu_data->getCell('C2')->setValue('姓名');
            $worksheet_stu_data->getCell('D2')->setValue('性别');
            for ($i = 0; $i < count($data_stu); $i++) {  //循环出excel所有的数据，并进行校验
                $worksheet_stu_data->setCellValue('A' . ($i + 3), $data_stu[$i]['email']);
                $worksheet_stu_data->setCellValue('B' . ($i + 3), $data_stu[$i]['stu_no']);
                $worksheet_stu_data->setCellValue('C' . ($i + 3), $data_stu[$i]['stu_name']);
                $worksheet_stu_data->setCellValue('D' . ($i + 3), $data_stu[$i]['gender'] == 0 ? "男" : "女");
            }
            $writer_stu_data = new Xlsx($spreadsheet_stu_data);
            $writer_stu_data->save('storage/' . $class_id . '/stu_data' . '/' . $class_id . '_stu_data.xlsx');
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            return $e->getMessage();
        }
        return config('status.success');
    }



    /**
     * 分析导入的excel文件
     */
    public function scanExcel($class_id, $file)
    {
        $exts = ['xls', 'xlsx'];  //限制文件格式

        $file_ext = $file->extension();  //获取文件的后缀
        // 校验文件格式
        if (!in_array($file_ext, $exts)) {
            return config('status.upfile_excel_ext_err');
        }
        $spreadsheet = IOFactory::load($file); //载入xlsx文件
        $worksheet = $spreadsheet->getActiveSheet(); //读取excel文件
        $excel_class_id = $worksheet->getCell('A1')->getvalue();  //获取班级代码
        if ($excel_class_id != $class_id) {
            return config('status.upfile_excel_class_err');
        }

        $row_count = $worksheet->getHighestRow(); //读取excel最大行数，即学生的数量 = row_Count - 前两个标题行
        if ($row_count < 3) {
            return config('status.upfile_excel_no_exist');
        }
        for ($i = 3; $i <= $row_count; $i++) {  //循环出excel所有的数据，并进行校验
            if ($worksheet->getCell('A' . $i)->getvalue() == "") {
                return config('status.upfile_excel_no_exist');
            }

            $patt_email = "/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/";
            if (!(preg_match($patt_email, $worksheet->getCell('A' . $i)->getvalue()))) { //如果不匹配邮箱
                return config('status.upfile_excel_context_err');
            }

            if ($worksheet->getCell('B' . $i)->getvalue() == "") {
                return config('status.upfile_excel_no_exist');
            }
            if ($worksheet->getCell('C' . $i)->getvalue() == "") {
                return config('status.upfile_excel_no_exist');
            }
            if ($worksheet->getCell('D' . $i)->getvalue() == "") {
                return config('status.upfile_excel_no_exist');
            }
            if ($worksheet->getCell('D' . $i)->getvalue() != "男" && $worksheet->getCell('D' . $i)->getvalue() != "女") {
                return config('status.upfile_excel_context_err');
            }

            $data['stu'][$i - 3]['class_id'] = $class_id;
            $data['stu'][$i - 3]['email'] = $worksheet->getCell('A' . $i)->getvalue();
            $data['stu'][$i - 3]['stu_no'] = $worksheet->getCell('B' . $i)->getvalue();
            $data['stu'][$i - 3]['stu_name'] = $worksheet->getCell('C' . $i)->getvalue();
            $data['stu'][$i - 3]['gender'] = ($worksheet->getCell('D' . $i)->getvalue() == "男") ? "0" : "1";

            //    密码随机生成8位
            $characters = '1234567890abcdefghijklmnopqrstuvwxyz';
            $data['stu'][$i - 3]['stu_pwd'] = '';
            for ($j = 0; $j < 8; $j++) {
                $index = rand(0, strlen($characters) - 1);
                $data['stu'][$i - 3]['stu_pwd'] .= $characters[$index];
            }
            $data['stu'][$i - 3]['add_time'] = date('Y-m-d H:i:s', time());
            $data['stu'][$i - 3]['last_time'] = date("Y-m-d H:i:s", time());
        }

        $this->createExcel($class_id, $data['stu']);

        // $is_all 批量添加标识
        $this->stuModel->addStu($data['stu'], true);
    }

    /**
     * 删除学生数据
     */
    public function delStu($class_id, $stu_no, $is_clear_all)
    {
        if ($is_clear_all) { //清空所有数据
            // 清空 stu\works\is_work\works\score 数据表
            // 启动事务
            $this->stuModel->delStu($class_id);
            $this->isWorkodel->delIsWork($class_id);
            $this->worksModel->delWorks($class_id);
            $this->scoreModel->delScore($class_id);

            // 清空文件
            $errCode =  $this->clearExcel($class_id);
            if ($errCode !=  config('status.success')) {
                if ($errCode == config('status.error')) {
                    return config('status.error');
                } else {
                    return $errCode;
                }
            }

            // 创建新的stu_data.xlsx文件
            $errCode = $this->createExcel($class_id);
            if ($errCode !=  config('status.success')) {
                if ($errCode == config('status.error')) {
                    return config('status.error');
                } else {
                    return $errCode;
                }
            }
            return config('status.success');
        } else {  //删除单条数据
            // 清空 stu\works\is_work\works\score 数据表

            $this->stuModel->delStu($class_id, $stu_no);
            $this->isWorkodel->delISWork($class_id, $stu_no);
            $this->worksModel->delWorks($class_id, $stu_no);
            $this->scoreModel->delScore($class_id, $stu_no);

            // 清空文件
            $errCode =  $this->clearExcel($class_id);
            if ($errCode !=  config('status.success')) {
                if ($errCode == config('status.error')) {
                    return config('status.error');
                } else {
                    return $errCode;
                }
            }

            // 创建新的stu_data.xlsx文件
            $errCode = $this->createExcel($class_id);
            if ($errCode !=  config('status.success')) {
                if ($errCode == config('status.error')) {
                    return config('status.error');
                } else {
                    return $errCode;
                }
            }
        }
        return config('status.success');
    }

    /**
     * 获取压缩包
     */
    public function getZip($class_id)
    {
        $this->zip1->zip($class_id, 'stu_data');
    }

    /**
     * 推送密码邮件服务
     */
    public function sendEmail($data, $is_all)
    {
        $admin = $this->adminModel->findByAdmin($data['admin']);
        $class_id = $data['class_id'];
        $class_name = $data['class_name'];
        $stu_no = $data['stu_no'];

        if ($is_all == 0) { //单独发送密码
            $stu = $this->stuModel->findStu($class_id, $stu_no)->toArray();
            $this->sendEmailServer($stu, $admin, $class_name);
        }
        if ($is_all == 1) { //群发密码
            $stu_data = $this->stuModel->getStuListToExcel($class_id);
            foreach ($stu_data as $v) {
                $this->sendEmailServer($v, $admin, $class_name);
            }
        }
        return config('status.success');
    }


    /**
     * 清空原文件
     */
    private function clearExcel($class_id)
    {
        if (file_exists('storage' . '/' . $class_id . '/stu_data' . '/' . $class_id . '_stu_data.xlsx')) {
            $res = $this->file->unlink_file('storage' . '/' . $class_id . '/stu_data' . '/' . $class_id . '_stu_data.xlsx');
            if (!$res) {
                return config('status.error');
            }
            return config('status.success');
        }
        return config('status.success');
    }

    /**邮件发送服务 */
    private function sendEmailServer($stu, $admin, $class_name)
    {
        $mail = new PHPMailer(true);  //开启邮箱发送

        try {
            //服务器配置
            $mail->CharSet = "UTF-8";                     //设定邮件编码
            $mail->SMTPDebug = 0;                        // 调试模式输出
            $mail->isSMTP();                             // 使用SMTP
            $mail->Host = $admin['email_system'];                // SMTP服务器
            $mail->SMTPAuth = true;                      // 允许 SMTP 认证
            $mail->Username = $admin['email'];  // SMTP 用户名  即邮箱的用户名
            $mail->Password = $admin['check_code'];         // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
            $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

            $mail->setFrom($admin['email'], $class_name);  //发件人
            $mail->addAddress($stu['email'], $stu['stu_name']);  // 收件人
            //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
            $mail->addReplyTo($admin['email'], $class_name); //回复的时候回复给哪个邮箱 建议和发件人一致

            //Content
            $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = $stu['stu_name'] . '你好！智慧作业上传评分系统门户【' . $class_name . '】';
            $mail->Body    = '<h1>智慧作业上传评分系统门户</h1><p>网站地址：' . $admin['server_ip'] . '</p><p>班级代码：' . $stu['class_id'] . '</p><p>账号：' . $stu['stu_no'] . '</p><p>密码：' . $stu['stu_pwd'] . '</p>';
            $mail->AltBody = '<p>网站地址：' . $admin['server_ip'] . '</p><p>班级代码：' . $stu['class_id'] . '</p><p>账号：' . $stu['stu_no'] . '</p><p>密码：' . $stu['stu_pwd'] . '</p>';

            $mail->send();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
