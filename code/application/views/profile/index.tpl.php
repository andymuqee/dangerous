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
<div class="row">
    <div class="col-sm-9">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="m-b-md">
                                <!--                                <a href="project_detail.html#" class="btn btn-white btn-xs pull-right">编辑项目</a>-->
                                <h2><?php e($department_name); ?>成员</h2>
                            </div>
                            <dl class="dl-horizontal">
                                <dt>状态：</dt>
                                <dd><span class="label label-primary">正常</span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <dl class="dl-horizontal">
                                <dt>姓名：</dt>
                                <dd>吴迪</dd>
                                <dt class="m-t">性别：</dt>
                                <dd class="m-t">男</dd>
                                <dt class="m-t">职工号：</dt>
                                <dd class="m-t">2103208384387</dd>
                                <dt class="m-t">所属角色：</dt>
                                <dd class="m-t"><?php e($role_name); ?></dd>
                                <dt class="m-t">所属岗位</dt>
                                <dd class="m-t"><?php e($past_name); ?></dd>
                                <dt class="m-t">个人简介</dt>
                                <dd class="m-t"><?php e($remark); ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="wrapper wrapper-content project-manager">
            <h4>头像</h4>
            <img src="/assets/img/profile_small.jpg" class="img-responsive">
            <p class="small">
                <br>签名内容
            </p>
            <div class="m-t-md">
                <a href="/profile/avatar" class="btn btn-xs btn-primary">修改头像</a>
            </div>
        </div>
    </div>
</div>

<?php e($base_js); ?>

<script>
    $(document).ready(function () {

        $('#loading-example-btn').click(function () {
            btn = $(this);
            simpleLoad(btn, true)

            // Ajax example
            //                $.ajax().always(function () {
            //                    simpleLoad($(this), false)
            //                });

            simpleLoad(btn, false)
        });
    });

    function simpleLoad(btn, state) {
        if (state) {
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Loading");
        } else {
            setTimeout(function () {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Refresh");
            }, 2000);
        }
    }
</script>

</body>

</html>
