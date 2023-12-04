<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生修改</title>
    <link rel="stylesheet" href="{__LAYUI_CSS_PATH__}">
    <script src="{__LAYUI_JS_PATH__}"></script>
</head>

<body style="padding:10px">
    <input type="hidden" name="__token__" value="{$token}" />
    <input type="hidden" name="stu_no" class="layui-input" value="{$stu.stu_no}">
    <input type="hidden" name="class_id" class="layui-input" value="{$stu.class_id}">
    <table class="layui-table">
        <thead>
            <tr>
                <td>学号</td>
                <td>姓名</td>
                <td>性别</td>
                <td>邮箱</td>
                <td>登录密码</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="stu_no" class="layui-input" value="{$stu.stu_no}" disabled></td>
                <td><input type="text" name="stu_name" class="layui-input" value="{$stu.stu_name}"></td>
                <td>
                    男<input type="radio" name="gender" value="0" title="男" {$stu.gender==0?"checked":""}>
                    女 <input type="radio" name="gender" value="1" title="女" {$stu.gender==1?"checked":""}>
                </td>
                <td><input type="email" name="email" class="layui-input" value="{$stu.email}"></td>
                <td><input type="text" name="stu_pwd" class="layui-input" value="{$stu.stu_pwd}"></td>

            </tr>
        </tbody>
    </table>
    <button class="layui-btn layui-btn-normal" onclick="save()">保存</button>
    <script>
    var $ = layui.jquery;

    function save() {
        var __token__ = $('input[name="__token__"]').val();
        var stu_no = $('input[name="stu_no"]').val();
        var class_id = $('input[name="class_id"]').val();
        var stu_name = $('input[name="stu_name"]').val();
        var gender = $('input[name="gender"]:checked').val();
        var stu_pwd = $('input[name="stu_pwd"]').val();
        var email = $('input[name="email"]').val();

        if (stu_name == '' || email == '' || stu_pwd == '') {
            layer.msg('必填项不能为空', {
                icon: 2
            })
        } else {
            $.post('/teacher/class_stu_edit', {
                __token__,
                stu_no,
                class_id,
                stu_name,
                gender,
                stu_pwd,
                email,
            }, function(res) {
                if (res.status != 200) {
                    layer.msg(res.result, {
                        icon: 2
                    })
                } else {
                    layer.msg(res.result, {
                        icon: 1
                    })
                    setTimeout(function() {
                        parent.window.location.reload()
                    }, 1000);
                }
            }, 'json');
        }

    }
    </script>
</body>

</html>