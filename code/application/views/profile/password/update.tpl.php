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

<body class="gray-bg">
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?php e($page_subtitle); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a>主页</a>
            </li>
            <li>
                <strong><?php e($page_subtitle); ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="javascript:window.location.reload();" class="btn btn-primary"><i class="fa fa-refresh"></i>
                刷新本页</a>
            <a id="frmBatch" href="javascript:void(0);" class="btn btn-primary"><i class="fa fa-times"></i> 放弃</a>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12 animated fadeInRight">
            <div class="mail-box">
                <div class="mail-body">
                    <form class="form-horizontal" method="post" action="/profile/password/save" id="myForm">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">新密码：</label>
                            <div class="col-sm-9">
                                <input type="password" id="password" name="password" class="form-control"
                                       placeholder="请输入新密码">
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">重复密码：</label>
                            <div class="col-sm-9">
                                <input type="password" id="repassword" name="repassword" class="form-control"
                                       placeholder="请输入重复密码">
                                <input type="hidden" name="user_id" value="<?php e($user_id) ?>"/>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mail-body text-right tooltip-demo">
                    <a href="javascript:$('#myForm').submit();" class="btn btn-sm btn-primary" data-toggle="tooltip"
                       data-placement="top"
                       title="Send"><i class="fa fa-reply"></i> 提交</a>
                    <a href="javascript:history.go(-1);" class="btn btn-white btn-sm" data-toggle="tooltip"
                       data-placement="top"
                       title="Discard email"><i class="fa fa-times"></i> 放弃</a>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>
    </div>
</div>

<?php e($base_js); ?>

<script>
    $(document).ready(function () {
        // validate signup form on keyup and submit
        var icon = "<i class='fa fa-times-circle'></i> ";
        var validator = $("#myForm").validate({
            submitHandler: function (form) {
                $(form).ajaxSubmit(function (ret) {
                    JSON.parse(ret).code == 200 ? layer.msg('修改成功') : layer.msg('修改失败');
                    validator.resetForm();
                });
            },
            rules: {
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 18
                },
                repassword: {
                    required: true,
                    minlength: 6,
                    maxlength: 18,
                    equalTo: "#password"
                },
            },
            messages: {
                password: {
                    required: icon + "请输入您的密码",
                    minlength: icon + "密码必须6-18个字符之间"
                },
                repassword: {
                    required: icon + "请再次输入密码",
                    minlength: icon + "密码必须6-18个字符之间",
                    equalTo: icon + "两次输入的密码不一致"
                }
            }
        });
    });
</script>

</body>

</html>
