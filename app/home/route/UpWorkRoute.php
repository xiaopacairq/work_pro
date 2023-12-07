<?php

use think\facade\Route;

/**
 * account
 */
Route::get('class_upwork', 'upWork/index');
Route::get('class_upwork_details', 'upWork/details');
Route::post('class_upwork_details_is_true', 'upWork/isTrue');
Route::post('class_upwork_details_upfile', 'upWork/upfile');
Route::post('class_upwork_details_delfile', 'upWork/delfile');
