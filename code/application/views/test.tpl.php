<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> - </title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <?php e($base_css); ?>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-8 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <a href="javascript:history.go(-1);" class="btn btn-danger btn-sm" data-toggle="tooltip"
                       data-placement="top"
                       title="放弃"><i class="fa fa-times"></i> 放弃</a>
                </div>
                <h2>
                </h2>
            </div>
            <div class="mail-box">
                <div class="mail-body">
                    <form class="form-horizontal" method="post" action="/profile/password/save" id="myForm">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">用户ID：</label>
                            <div class="col-sm-9">
                                <input type="hidden" id="user_id" name="user_id" class="form-control"
                                       placeholder="请输入用户ID" value="<?php e($user_id); ?>"/>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">用户名：</label>
                            <div class="col-sm-9">
                                <input type="text" id="username" name="username" class="form-control"
                                       placeholder="请输入用户名" value="<?php e($username); ?>"/>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">密码：</label>
                            <div class="col-sm-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">：</label>
                            <div class="col-sm-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">真实姓名：</label>
                            <div class="col-sm-9">
                                <input type="text" id="realname" name="realname" class="form-control"
                                       placeholder="请输入真实姓名" value="<?php e($realname); ?>"/>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">：</label>
                            <div class="col-sm-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">：</label>
                            <div class="col-sm-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">：</label>
                            <div class="col-sm-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">：</label>
                            <div class="col-sm-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">：</label>
                            <div class="col-sm-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">：</label>
                            <div class="col-sm-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">：</label>
                            <div class="col-sm-9">
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
        <div class="col-sm-3">
            <div class="wrapper wrapper-content project-manager">
                <h4>头像</h4>
                <img src="img/profile_small.jpg" class="img-responsive">
                <p class="small">
                    <br>签名内容
                </p>
                <div class="m-t-md">
                    <a href="project_detail.html#" class="btn btn-xs btn-primary">修改头像</a>
                </div>
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
                    JSON.parse(ret).response.code == 200 ? layer.msg('修改成功') : layer.msg('修改失败');
                    validator.resetForm();
                });
            },
            rules: {
                user_id: {
                    required: true,
                },
                username: {
                    required: true,
                    minlength: 6, maxlength: 32,
                },
                password: {
                    required: true,
                    minlength: 6, maxlength: 32,
                },
                type: {
                    required:,
                },
                realname: {
                    required: true,
                    minlength: 6, maxlength: 32,
                },
                department_id: {
                    required:,
                },
                role_id: {
                    required:,
                },
                post_id: {
                    required:,
                },
                remark: {
                    required:,
                },
                created: {
                    required:,
                },
                modified: {
                    required:,
                },
                avatar: {
                    required:,
                },
            },
            messages: {
                user_id: {
                    required: icon + "请输入用户ID",
                },
                username: {
                    required: icon + "请输入用户名",
                    minlength: icon + "密码必须6-32个字符之间",
                },
                password: {
                    required: icon + "请输入密码",
                    minlength: icon + "密码必须6-32个字符之间",
                },
                type: {
                    required: icon + "请输入",
                },
                realname: {
                    required: icon + "请输入真实姓名",
                    minlength: icon + "密码必须6-32个字符之间",
                },
                department_id: {
                    required: icon + "请输入",
                },
                role_id: {
                    required: icon + "请输入",
                },
                post_id: {
                    required: icon + "请输入",
                },
                remark: {
                    required: icon + "请输入",
                },
                created: {
                    required: icon + "请输入",
                },
                modified: {
                    required: icon + "请输入",
                },
                avatar: {
                    required: icon + "请输入",
                },
            }
        });
    });
</script>

</body>

</html>
