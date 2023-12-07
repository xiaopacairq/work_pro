<?php

namespace app\common\business\admin;

// use app\common\model\admin\Classes as ClassesModel;

use file\File;
use file\Zip;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * 执行核心逻辑
 */
class Classes
{
    // private $classesModel = null;
    private $file = null;
    private $zip = null;

    public function __construct()
    {
        // 核心逻辑
        // $this->classesModel = new ClassesModel();
        $this->file = new File();
        $this->zip = new Zip();
    }

    /**
     * 创建班级的信息储存表
     */
    public function createFile($class_id)
    {
        // 创建stu_data、stu_work、stu_score文件夹三个
        $res1 = $this->file->create_dir('storage' . '/' . $class_id . '/stu_data');
        $res2 = $this->file->create_dir('storage' . '/' . $class_id . '/stu_work');
        $res3 = $this->file->create_dir('storage' . '/'  . $class_id . '/stu_score');
        $res4 = $this->file->create_file('storage' . '/'  . $class_id . '/stu_work' . '/read.txt');

        // 如果创建文件失败，立刻抛出错误
        if (!$res1) {
            return config('status.error');
        }
        if (!$res2) {
            return config('status.error');
        }
        if (!$res3) {
            return config('status.error');
        }
        if (!$res4) {
            return config('status.error');
        }

        try {
            // 创建stu_data.xlsx文件
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
            $worksheet = $spreadsheet_stu_data->getActiveSheet();
            $writer_stu_data = new Xlsx($spreadsheet_stu_data);
            $writer_stu_data->save('storage' . '/' . $class_id . '/stu_data' . '/' . $class_id . '_stu_data.xlsx');

            // 创建stu_score.xlsx文件
            $spreadsheet_stu_score = new Spreadsheet();
            $spreadsheet_stu_score->getActiveSheet()->getCell('A1')->setValue('学号');
            $spreadsheet_stu_score->getActiveSheet()->getCell('B1')->setValue('姓名');
            $spreadsheet_stu_score->getActiveSheet()->getCell('C1')->setValue('平时成绩');
            $worksheet = $spreadsheet_stu_score->getActiveSheet();
            $writer_stu_score = new Xlsx($spreadsheet_stu_score);
            $writer_stu_score->save('storage' . '/' . $class_id . '/stu_score' . '/' . $class_id . '_stu_score.xlsx');
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            return $e->getMessage();
        }



        return config('status.success');
    }

    /**
     * 删除班级的信息储存表
     */
    public function delFile($class_id)
    {
        if (file_exists('storage/' . $class_id)) {
            $res = $this->file->remove_dir('storage/' . $class_id, true);
            if (!$res) {
                return config('status.error');
            }
        }
        return config('status.success');
    }

    /**
     * 获取zip压缩
     */
    public function getZip($class_id)
    {
        $this->zip->zip($class_id);
    }
}
