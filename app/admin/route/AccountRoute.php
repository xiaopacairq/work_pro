<?php

use think\facade\Route;

/**
 * account
 */
Route::get('login', 'account/index');
Route::get('verify', 'account/verify');
Route::post('check', 'account/doLogin');