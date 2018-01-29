<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php e($page_title); ?> - <?php e($page_subtitle); ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <?php e($base_css); ?>
</head>

<body class="gray-bg"
      style="background: url(<?php e(config_item('assets_url')); ?>/img/Signin_background_img.png) no-repeat; background-color:#2f353a;background-size: 100% 100%; padding-top: 100px">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <span class="logo-name" style="font-size: 26px;letter-spacing: 0">危险品检验系统</span>
        </div>
        <h3>v1.0版本</h3>

        <form class="m-t" role="form" id="submit">
            <div class="form-group">
                <input id="username" type="text" class="form-control" placeholder="用户名" required="">
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control" placeholder="密码" required="">
            </div>
            <button id="submit" type="button" class="btn btn-primary block full-width m-b">登 录</button>


            <p class="text-muted text-center">
                <small>copyright 2017-2018 沈阳铁路局科学技术研究所</small>
            </p>

        </form>
    </div>
</div>

<!-- 全局js -->
<?php e($base_js); ?>
<script src="<?php e(config_item('assets_url')); ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php e(config_item('assets_url')); ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- 自定义js -->
<script src="<?php e(config_item('assets_url')); ?>/js/hplus.js?v=4.1.0"></script>
<script src="<?php e(config_item('assets_url')); ?>/js/contabs.js"></script>

<script src="<?php e(config_item('assets_url')); ?>/js/plugins/layer/layer.min.js"></script>
<script>
    $(function () {
        //回车提交事件
        $("body").keydown(function () {
            if (event.keyCode == "13") {//keyCode=13是回车键
                $("#submit").click();
            }
        });
        $("input").focus(function () {
            $(this).parent("label").css("color", "#fff");
            $(this).parent().siblings("label").css("color", "#b2b2b2");
        })
        $("#submit").click(function () {
            var a = vailNickName();
            var b = vailPwd();
            // var c=verify();
            if (a === true && b === true) {
                //location.href="/sys/member/login_do";
                var index = parent.layer.load(1, {shade: [0.5, '#000000']});
                $.ajax({
                    url: "/sys/member/login_do<?php e($r);?>",
                    type: "POST",
                    dataType: "json",
                    // contentType: "application/json",
                    data: {username: $('#username').val(), password: $('#password').val()},
                    success: function (data) {
                        if (data.state == 'success') {
                            layer.msg('登录成功！');
                        } else {
                            layer.msg('登录失败！');
                        }
                        parent.layer.close(index);
                        window.location.href = data.redirect_url;
                    }
                });
            }
        })

        //用户名验证
        function vailNickName() {
            var nickName = $("#username").val();
            if (nickName.length === 0) {
                layer.msg("用户名不能为空！");
                return false;
            }
            else if (nickName.length < 4 || nickName.length > 16) {
                layer.msg("用户名为4-16个字符!");
                return false;
            }
            else {
                $("#username").parent("label").css("border-bottom", "1px solid #dddddd");
                $(".toast-error").css("visibility", "hidden");
                return true;
            }
        }

        //用户密码验证
        function vailPwd() {
            var password = $("#password").val();
            var message = "";
            var patrn = /^\d+$/;
            if (password == '') {
                message = "密码不能为空！";
                layer.msg(message);
                return false;
            }
            else if (password.length < 6 || password.length > 16) {
                message = "密码6-16位！";
                layer.msg(message);
                return false;
            }
            else if (patrn.test(password)) {
                message = "密码不能全是数字！";
                layer.msg(message);
                return false;
            }
            else {
                $("#password").parent("label").css("border-bottom", "1px solid #dddddd");
                return true;
            }


        }

        function change() {
            code = $("#code");
            // 验证码组成库
            var arrays = new Array(
                '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
                'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
                'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
                'u', 'v', 'w', 'x', 'y', 'z',
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
                'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
                'U', 'V', 'W', 'X', 'Y', 'Z'
            );
            codes = '';// 重新初始化验证码
            for (var i = 0; i < 4; i++) {
                // 随机获取一个数组的下标
                var r = parseInt(Math.random() * arrays.length);
                codes += arrays[r];
            }
            // 验证码添加到input里
            code.val(codes);
        }

        change();
        $("#code").click(function () {
            change();
        });

        //用户验证码验证
        function verify() {
            var inputCode = $("#input").val().toUpperCase(); //取得输入的验证码并转化为大写
            if (inputCode.length == 0) { //若输入的验证码长度为0
                $("#input").parent("label").css("border-bottom", "1px solid #ff4444");
                $(".toast-error").css("visibility", "visible");
                $(".toast-error .toast-text").text("请输入验证码！");
                return false;
            }
            else if (inputCode != codes.toUpperCase()) { //若输入的验证码与产生的验证码不一致时
                change();//刷新验证码
                $("#input").val("");//清空文本框
                $("#input").parent("label").css("border-bottom", "1px solid #ff4444");
                $(".toast-error").css("visibility", "visible");
                $(".toast-error .toast-text").text("验证码输入错误!请重新输入");
                return false;
            }
            else {
                $("#input").parent("label").css("border-bottom", "1px solid #ddd");
                return true;
            }


        }


    })
</script>
</body>

</html>
