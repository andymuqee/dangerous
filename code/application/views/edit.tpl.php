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
                <h2>
                    <?php e($page_subtitle); ?>
                </h2>
            </div>
            <div class="mail-box">
                <div class="mail-body">
                    <form class="form-horizontal" method="post" action="/profile/password/save" id="myForm">
                        <?php foreach ($data as $d):$f = json_decode($d['COLUMN_COMMENT']); ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">原密码：</label>
                                <div class="col-sm-9">
                                    <?php switch ($f->type): ?>
<?php case 'text': ?>
                                        <?php case 'hidden': ?>
                                            <input type="<?php e($f->type); ?>" id="<?php e($data['COLUMN_NAME']); ?>"
                                                   name="<?php e($data['COLUMN_NAME']); ?>" class="form-control"
                                                   placeholder="请输入<?php e($f->title); ?>">
                                            <span class="help-block m-b-none"></span>
                                        <?php case 'select': ?>
                                            <select id="<?php e($data['COLUMN_NAME']); ?>"
                                                    name="<?php e($data['COLUMN_NAME']); ?>">
                                                <option></option>
                                            </select>
                                            <span class="help-block m-b-none"></span>
                                        <?php case 'radio':
                                            foreach ($f->option as $d):
                                                ?>
                                                <div class="checkbox checkbox-inline">
                                                    <input type="radio" id="<?php e($data['COLUMN_NAME']); ?>"
                                                           name="<?php e($data['COLUMN_NAME']); ?>"
                                                           value="<?php e($d->v); ?>">
                                                    <label for="inlineCheckbox1"> <?php e($d->n); ?> </label>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php case 'check':
                                            foreach ($f->option as $d):
                                                ?>
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="<?php e($data['COLUMN_NAME']); ?>"
                                                           name="<?php e($data['COLUMN_NAME']); ?>"
                                                           value="<?php e($d->v); ?>">
                                                    <label for="inlineCheckbox1"> <?php e($d->n); ?> </label>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endswitch; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
        <?php foreach ($data as $d):$f = json_decode($d['COLUMN_COMMENT']);?>
        <?php e($data['COLUMN_NAME']);?>:
        {
            required: <?php e($f->required);?>,
            <?php if(@is_vail($f->range[0])):?>minlength: <?php e($f->range[0]);?><?php endif;?>,
            <?php if(@is_vail($f->range[1])):?>maxlength: <?php e($f->range[1]);?><?php endif;?>,
        }
    ,
        <?php endforeach;?>
    },
        messages: {
            <?php foreach ($data as $d):$f = json_decode($d['COLUMN_COMMENT']);?>
            <?php e($data['COLUMN_NAME']);?>:
            {
                required: icon + "请输入<?php e($f->title);?>",
                    <?php if(@is_vail($f->range[0])):?>minlength
            :
                icon + "密码必须<?php e($f->range[0]);?>-<?php e($f->range[1]);?>个字符之间"<?php endif;?>,
            }
        ,
            <?php endforeach;?>
        }
    })
        ;
    });
</script>

</body>

</html>
