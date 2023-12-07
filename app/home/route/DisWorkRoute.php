<?php

use think\facade\Route;

/**
 * account
 */
Route::get('class_diswork', 'disWork/index');
Route::get('class_diswork_display', 'disWork/display');
Route::rule('class_diswork_remarks', 'disWork/remarks');
