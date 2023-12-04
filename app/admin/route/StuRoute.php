<?php

use think\facade\Route;

/**
 * stu
 */
Route::rule('class_stu', 'stu/index');
Route::rule('class_stu_add', 'stu/add');
Route::rule('class_stu_edit', 'stu/edit');
Route::post('class_stu_del', 'stu/del');

Route::rule('class_stu_upfile', 'stu/upfileStu');
Route::rule('class_stu_get_zip', 'stu/getZip');
Route::post('class_stu_send_email', 'stu/sendEmailStu');