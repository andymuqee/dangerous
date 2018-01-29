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
                    <form class="form-horizontal" method="post" action="/team/save" id="myForm">
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