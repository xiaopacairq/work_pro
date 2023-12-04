<?php

use think\facade\Route;

/**
 * work
 */
Route::rule('class_work', 'work/index');
Route::rule('class_work_add', 'work/add');
Route::rule('class_work_edit', 'work/edit');
Route::post('class_work_del', 'work/del');

Route::rule('class_work_detail', 'work/detail');
Route::rule('class_work_get_zip', 'work/getZip');