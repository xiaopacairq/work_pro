<?php

use think\facade\Route;

/**
 * classes
 */
Route::rule('welcome', 'classes/index');
Route::rule('info', 'classes/information');

Route::rule('class_add', 'classes/add');
Route::rule('class_edit', 'classes/edit');
Route::post('class_del', 'classes/del');

// 获取压缩包
Route::rule('class_get_zip', 'classes/getZip');