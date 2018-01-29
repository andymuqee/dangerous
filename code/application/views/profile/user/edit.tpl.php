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
        <div class="col-sm-8 animated fadeInRight">
            <div class="mail-box">
                <div class="mail-body">
                    <form class="form-horizontal" method="post" action="/profile/user/save?ajax=true" id="myForm">
                        <input type="hidden" name="user_id" value="<?php e($user_id); ?>"/>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">用户名：</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       id="username"
                                       name="username" class="form-control"
                                       value="<?php e($data->username) ?>"
                                       placeholder="请输入用户名" <?php $is_new == "false" ? e('disabled') : ''; ?>>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">类型：</label>
                            <div class="col-sm-9">
                                <div class="checkbox checkbox-inline">
                                    <input type="radio" id="type"
                                           name="type"
                                           value="1"
                                           <?php if ($data->type == 1): ?>checked="checked" <?php endif; ?>>
                                    <label for="inlineCheckbox1"> 普通用户 </label>
                                </div>
                                <div class="checkbox checkbox-inline">
                                    <input type="radio" id="type"
                                           name="type"
                                           value="2"
                                           <?php if ($data->type == 2): ?>checked="checked" <?php endif; ?>>
                                    <label for="inlineCheckbox1"> 管理员 </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">真实姓名：</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       id="realname"
                                       name="realname" class="form-control"
                                       placeholder="请输入真实姓名"
                                       value="<?php e($data->realname) ?>">
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">班组名称：</label>
                            <div class="col-sm-9">
                                <select id="team_id" name="team_id" class="form-control m-b">
                                    <option value="0">选择班组</option>
                                    <?php foreach ($team as $d): ?>
                                        <option value="<?php e($d->team_id); ?>"
                                                <?php if ($data->team_id == $d->team_id): ?>selected<?php endif; ?>><?php e($d->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">工资号：</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       id="salary_no"
                                       name="salary_no" class="form-control"
                                       placeholder="请输入工资号"
                                       value="<?php e($data->salary_no) ?>">
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">性别：</label>
                            <div class="col-sm-9">
                                <div class="checkbox checkbox-inline">
                                    <input type="radio" id="sexy"
                                           name="sexy"
                                           value="1"
                                           <?php if ($data->sexy == 1): ?>checked="checked" <?php endif; ?>>
                                    <label for="inlineCheckbox1"> 男 </label>
                                </div>
                                <div class="checkbox checkbox-inline">
                                    <input type="radio" id="sexy"
                                           name="sexy"
                                           value="2"
                                           <?php if ($data->sexy == 2): ?>checked="checked" <?php endif; ?>>
                                    <label for="inlineCheckbox1"> 女 </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">备注：</label>
                            <div class="col-sm-9">
                                <textarea id="remark" name="remark"
                                          class="form-control"><?php e($data->remark) ?></textarea>
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
                <img style="width:120px;height: 120px"
                     src="<?php e(@is_vail($data->avatar) ?: ($data->sexy == 1 ? '/assets/img/male.png' : '/assets/img/female.png')) ?>"
                     class="img-responsive">
                <p class="small">
                    <br>签名内容
                </p>
                <div class="m-t-md">
                    <a href="/profile/avatar" class="btn btn-xs btn-primary" target="_blank">修改头像</a>
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
                    JSON.parse(ret).code == 200 ? layer.msg('操作成功') : layer.msg('操作失败');
                    validator.resetForm();
                });
            },
            rules: {
                username: {
                    required: true,
                    minlength: 5,
                    maxlength: 18,
                },
                realname: {
                    required: true,
                    minlength: 2,
                    maxlength: 18
                },
                salary_no: {
                    required: true,
                    minlength: 6,
                    maxlength: 18,
                },
            },
            messages: {
                username: {
                    required: icon + "请输入用户名",
                    minlength: icon + "密码必须6-18个字符之间"
                },
                realname: {
                    required: icon + "请输入真实姓名",
                    minlength: icon + "密码必须2-18个字符之间"
                },
                salary_no: {
                    required: icon + "请输入工资号",
                    minlength: icon + "密码必须6-18个字符之间",
                }
            }
        });
    });
</script>

</body>

</html>