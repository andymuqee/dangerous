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
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-8 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <a href="javascript:history.go(-1);" class="btn btn-danger btn-sm" data-toggle="tooltip"
                       data-placement="top"
                       title="放弃"><i class="fa fa-times"></i> 放弃</a>
                </div>
                <h2><?php e($page_subtitle); ?></h2>
            </div>
            <div class="mail-box">
                <div class="mail-body">
                    <form class="form-horizontal" method="post" action="/user/save" id="myForm">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">用户ID：</label>
                            <div class="col-sm-9">
                                <input type="hidden"
                                       id=""
                                       name="" class="form-control"
                                       placeholder="请输入用户ID">
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">用户名：</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       id=""
                                       name="" class="form-control"
                                       placeholder="请输入用户名">
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">密码：</label>
                            <div class="col-sm-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">类型：</label>
                            <div class="col-sm-9">
                                <div class="checkbox checkbox-inline">
                                    <input type="radio" id=""
                                           name=""
                                           value="1">
                                    <label for="inlineCheckbox1"> 普通用户 </label>
                                </div>
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id=""
                                           name=""
                                           value="1">
                                    <label for="inlineCheckbox1"> 普通用户 </label>
                                </div>
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id=""
                                           name=""
                                           value="2">
                                    <label for="inlineCheckbox1"> 管理员 </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">真实姓名：</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       id=""
                                       name="" class="form-control"
                                       placeholder="请输入真实姓名">
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">班组名称：</label>
                            <div class="col-sm-9">
                                <select id=""
                                        name="" class="form-control">
                                    <option></option>
                                </select>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">所属角色：</label>
                            <div class="col-sm-9">
                                <select id=""
                                        name="" class="form-control">
                                    <option></option>
                                </select>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">所属岗位：</label>
                            <div class="col-sm-9">
                                <select id=""
                                        name="" class="form-control">
                                    <option></option>
                                </select>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">照片：</label>
                            <div class="col-sm-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">身份证号：</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       id=""
                                       name="" class="form-control"
                                       placeholder="请输入身份证号">
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">民族：</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       id=""
                                       name="" class="form-control"
                                       placeholder="请输入民族">
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">出生日期：</label>
                            <div class="col-sm-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">工资号：</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       id=""
                                       name="" class="form-control"
                                       placeholder="请输入工资号">
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">性别：</label>
                            <div class="col-sm-9">
                                <div class="checkbox checkbox-inline">
                                    <input type="radio" id=""
                                           name=""
                                           value="1">
                                    <label for="inlineCheckbox1"> 男 </label>
                                </div>
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id=""
                                           name=""
                                           value="1">
                                    <label for="inlineCheckbox1"> 男 </label>
                                </div>
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id=""
                                           name=""
                                           value="2">
                                    <label for="inlineCheckbox1"> 女 </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">备注：</label>
                            <div class="col-sm-9">
                                                                                    <textarea type="textarea"
                                                                                              id=""
                                                                                              name=""
                                                                                              class="form-control"
                                                                                              placeholder="请输入备注"></textarea>
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
        <!--        <div class="col-sm-3">-->
        <!--            <div class="wrapper wrapper-content project-manager">-->
        <!--                <h4>头像</h4>-->
        <!--                <img src="img/profile_small.jpg" class="img-responsive">-->
        <!--                <p class="small">-->
        <!--                    <br>签名内容-->
        <!--                </p>-->
        <!--                <div class="m-t-md">-->
        <!--                    <a href="project_detail.html#" class="btn btn-xs btn-primary">修改头像</a>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
</div>


<script>
    $(document).ready(function () {
        // validate signup form on keyup and submit
        var icon = "<i class='fa fa-times-circle'></i> ";
        var validator = $("#myForm").validate({
                submitHandler: function (form) {
                    $(form).ajaxSubmit(function (ret) {
                        JSON.parse(ret).response.code == 200 ? layer.msg('操作成功') : layer.msg('操作失败');
                        validator.resetForm();
                    });
                },
                rules: {
                    user_id: {
                        required: true,
                    ,
                ,
            },
            username
    :
        {
            required: true,
                minlength
        :
            6,
                maxlength
        :
            32,
        }
    ,
        password:{
            required: true,
                minlength
        :
            6,
                maxlength
        :
            32,
        }
    ,
        type:{
            required: true,
                ,
                ,
        }
    ,
        realname:{
            required: true,
                minlength
        :
            6,
                maxlength
        :
            32,
        }
    ,
        team_id:{
            required: true,
                ,
                ,
        }
    ,
        role_id:{
            required: true,
                ,
                ,
        }
    ,
        post_id:{
            required: true,
                ,
                ,
        }
    ,
        avatar:{
            required: false,
                ,
                ,
        }
    ,
        ID:{
            required: true,
                minlength
        :
            2,
                maxlength
        :
            24,
        }
    ,
        nation:{
            required: true,
                minlength
        :
            2,
                maxlength
        :
            24,
        }
    ,
        birthday:{
            required: true,
                ,
                ,
        }
    ,
        salary_no:{
            required: true,
                minlength
        :
            4,
                maxlength
        :
            4,
        }
    ,
        sexy:{
            required: true,
                ,
                ,
        }
    ,
        remark:{
            required: true,
                minlength
        :
            1,
                maxlength
        :
            2048,
        }
    ,
        created:{
            required: ,
        ,
        ,
        }
    ,
        modified:{
            required: ,
        ,
        ,
        }
    ,
    },
        messages: {
            user_id:{
                required: icon + "请输入用户ID",
                    ,
            }
        ,
            username:{
                required: icon + "请输入用户名",
                    minlength
            :
                icon + "输入必须6-32个字符之间",
            }
        ,
            password:{
                required: icon + "请输入密码",
                    minlength
            :
                icon + "输入必须6-32个字符之间",
            }
        ,
            type:{
                required: icon + "请输入类型",
                    ,
            }
        ,
            realname:{
                required: icon + "请输入真实姓名",
                    minlength
            :
                icon + "输入必须6-32个字符之间",
            }
        ,
            team_id:{
                required: icon + "请输入班组名称",
                    ,
            }
        ,
            role_id:{
                required: icon + "请输入所属角色",
                    ,
            }
        ,
            post_id:{
                required: icon + "请输入所属岗位",
                    ,
            }
        ,
            avatar:{
                required: icon + "请输入照片",
                    ,
            }
        ,
            ID:{
                required: icon + "请输入身份证号",
                    minlength
            :
                icon + "输入必须2-24个字符之间",
            }
        ,
            nation:{
                required: icon + "请输入民族",
                    minlength
            :
                icon + "输入必须2-24个字符之间",
            }
        ,
            birthday:{
                required: icon + "请输入出生日期",
                    ,
            }
        ,
            salary_no:{
                required: icon + "请输入工资号",
                    minlength
            :
                icon + "输入必须4-4个字符之间",
            }
        ,
            sexy:{
                required: icon + "请输入性别",
                    ,
            }
        ,
            remark:{
                required: icon + "请输入备注",
                    minlength
            :
                icon + "输入必须1-2048个字符之间",
            }
        ,
            created:{
                required: icon + "请输入",
                    ,
            }
        ,
            modified:{
                required: icon + "请输入",
                    ,
            }
        ,
        }
    })
        ;
    });
</script>

</body>

</html>