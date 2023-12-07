<?php

namespace app\common\business\admin;

use file\Zip1;
use file\File;
use PhpOffice\PhpSpreadsheet\IOFactory; //用于载入已有的xlsx文件
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; //保存xlsx文件

use app\common\model\Stu as StuModel;
use app\common\model\Work as WorkModel;
use app\common\model\IsWork as IsWorkModel;
use app\common\model\Score as ScoreModel;

/**
 * 执行核心逻辑
 */
class Score
{

    private $file = null;
    private $zip1 = null;
    private $stuModel = null;
    private $workModel = null;
    private $isWorkModel = null;
    private $scoreModel = null;

    // private $zip = null;

    public function __construct()
    {
        // 核心逻辑
        $this->file = new File();
        $this->zip1 = new Zip1();
        $this->stuModel = new StuModel();
        $this->workModel = new WorkModel();
        $this->isWorkModel = new IsWorkModel();
        $this->scoreModel = new ScoreModel();
    }

    /**
     * 学生导出
     */
    public function getZip($class_id)
    {
        $this->zip1->zip($class_id, 'stu_data');
    }

    /**
     * 循环出每个学生的信息
     */
    public function getStuScoreList($class_id)
    {
        $data['stu'] = $this->stuModel->getStuListByClassId($class_id);
        $data['work'] = $this->workModel->getWorkStatusList($class_id);
        $data['is_work'] = $this->isWorkModel->getIsWorkList($class_id);
        $data['scores'] = $this->scoreModel->getScoreGroupList($class_id);
        $data['work_count'] = count($data['work']);

        $data['work_count'] = count($data['work']);  //作业次数
        $stu_count = count($data['stu']);  //学生人数

        foreach ($data['stu'] as $k => $v) {
            //work\is_work\stu\score四表联查
            if ($data['work']) {
                //存在作业的情况下，输出作业
                //每个学生都有自己的作业
                $data['stu'][$k]['work'] = $data['work'];

                foreach ($data['work'] as $kk => $vv) {
                    //默认作业成绩为0
                    $data['stu'][$k]['work'][$kk]['score_all'] = 0;

                    if ($data['is_work']) { //存在了is_work数据项

                        foreach ($data['is_work'] as $kkk => $vvv) {

                            if ($data['stu'][$k]['stu_no'] == $data['is_work'][$kkk]['stu_no'] && $data['stu'][$k]['work'][$kk]['work_id'] == $data['is_work'][$kkk]['work_id'] &&  $data['is_work'][$kkk]['is_true'] == 1) { //如果作业号、且学号匹配，则该学生有上传数据
                                foreach ($data['scores'] as $kkkk => $vvvv) {
                                    if ($data['stu'][$k]['stu_no'] == $data['scores'][$kkkk]['stu_no'] && $data['stu'][$k]['work'][$kk]['work_id'] == $data['scores'][$kkkk]['work_id']) {
                                        $score_all = number_format($data['scores'][$kkkk]['score_all'] / $stu_count, 2);
                                        $data['stu'][$k]['work'][$kk]['score_all'] = $score_all;
                                    }
                                }
                            }
                        }
                    }
                }
            } else {  //没有作业的情况下，输出一个空数组
                $data['stu'][$k]['work'] = [];
            }
        }

        foreach ($data['stu'] as $k => $v) {
            $data['stu'][$k]['score_alls'] = 0; //总成绩平均分

            foreach ($v['work'] as $kk => $vv) {
                $data['stu'][$k]['score_alls'] = number_format(($data['stu'][$k]['score_alls'] + $vv['score_all']), 2);
            }
        }

        $this->clearExcel($class_id);
        $this->createScoreExcel($data['stu'], $data['work_count'], $class_id);

        return $data;
    }

    /**
     * 清除excel文件
     */
    public function clearExcel($class_id)
    {
        if (file_exists('storage' . '/' . $class_id . '/stu_data' . '/' . $class_id . '_stu_data.xlsx')) {
            $this->file->unlink_file('storage' . '/' . $class_id . '/stu_data' . '/' . $class_id . '_stu_data.xlsx');
        }
    }

    /**
     * 创建新的成绩表
     */
    public function createScoreExcel($stu, $work_count, $class_id)
    {
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->getCell('A' . 1)->setvalue('学号');
        $worksheet->getCell('B' . 1)->setvalue('姓名');
        $worksheet->getCell('C' . 1)->setvalue('平时成绩');
        for ($i = 0; $i < count($stu); $i++) {  //循环出所有的数据
            $worksheet->getCell('A' . ($i + 2))->setvalue($stu[$i]['stu_no']);
            $worksheet->getCell('B' . ($i + 2))->setvalue($stu[$i]['stu_name']);
            $worksheet->getCell('C' . ($i + 2))->setvalue(number_format($stu[$i]['score_alls'] / $work_count, 2));
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('storage/' . $class_id . '/stu_score' . '/' . $class_id . '_stu_score.xlsx');
    }
}
