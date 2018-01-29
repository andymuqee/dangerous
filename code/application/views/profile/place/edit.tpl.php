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
                    <form class="form-horizontal" method="post" action="/place/save" id="myForm">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">地点ID：</label>
                            <div class="col-sm-9">
                                <input type="hidden"
                                       id=""
                                       name="" class="form-control"
                                       placeholder="请输入地点ID">
                                <span class="help-block m-b-none"></span>
                                <select id=""
                                        name="">
                                    <option></option>
                                </select>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">地点名称：</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       id=""
                                       name="" class="form-control"
                                       placeholder="请输入地点名称">
                                <span class="help-block m-b-none"></span>
                                <select id=""
                                        name="">
                                    <option></option>
                                </select>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">所属提交用户ID：</label>
                            <div class="col-sm-9">
                                <select id=""
                                        name="">
                                    <option></option>
                                </select>
                                <span class="help-block m-b-none"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">排序：</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       id=""
                                       name="" class="form-control"
                                       placeholder="请输入排序">
                                <span class="help-block m-b-none"></span>
                                <select id=""
                                        name="">
                                    <option></option>
                                </select>
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
    :
        {
            required: true,
                ,
                ,
        }
    ,
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
    :
        {
            required: true,
                ,
                ,
        }
    ,
    :
        {
            required: true,
                minlength
        :
            1,
                maxlength
        :
            4,
        }
    ,
    :
        {
            required: ,
        ,
        ,
        }
    ,
    :
        {
            required: ,
        ,
        ,
        }
    ,
    },
        messages: {
        :
            {
                required: icon + "请输入地点ID",
                    ,
            }
        ,
        :
            {
                required: icon + "请输入地点名称",
                    minlength
            :
                icon + "输入必须6-32个字符之间",
            }
        ,
        :
            {
                required: icon + "请输入所属提交用户ID",
                    ,
            }
        ,
        :
            {
                required: icon + "请输入排序",
                    minlength
            :
                icon + "输入必须1-4个字符之间",
            }
        ,
        :
            {
                required: icon + "请输入",
                    ,
            }
        ,
        :
            {
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