<?php

/**
 * 状态码
 */

return [
    // 执行成功
    'success' => 200,
    //执行失败
    'failed' => 300,
    //执行错误
    'error' => 400,

    //登录token错误或失效
    'login_token_err' => 100001,
    //表单令牌token错误（重复提交）
    'form_token_err' => 100002,

    // 上传excel格式错误
    'upfile_excel_ext_err' => 100003,
    // 上传excel为空
    'upfile_excel_no_exist' => 100004,
    // 上传excel 班级代码错误
    'upfile_excel_class_err' => 100005,
    // 上传excel 内容格式错误
    'upfile_excel_context_err' => 100006,

    // 作业文件上传文件个数超过15个
    'work_file_max_err' => 100007,
    // 作业文件后缀不允许上传
    'work_file_ext_err' => 100008,
];
