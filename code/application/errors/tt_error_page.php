<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <title><?php echo(config_item('site_name')); ?></title>
    <?php include config_item('root_path') . '/application/views/layout/base_css.tpl.php'; ?>
    <link href="/www/css/page_msg.css" rel="stylesheet">
    <style>
        .msg_page .tool_bar {
            margin-top: 200px;
        }

        .page_msg.simple .inner {
            width: 30%;
            min-width: 0;
        }
    </style>
</head>
<body class="zh_CN fix-body">
<?php include config_item('root_path') . '/application/views/layout/header_base.tpl.php'; ?>
<div class="body msg_page " id="body">
    <div class="container_box">
        <div class="page_msg simple default ">
            <div class="inner group"><span class="msg_icon_wrapper"><i class="icon_msg warn"></i></span>
                <div class="msg_content">
                    <h4><?php echo $error_code; ?></h4>
                    <p><?php echo $error_msg; ?></p>
                </div>
            </div>
            <div class="border tool_bar tc"><a class="btn btn_primary" href="/account/register/get?step=1">重新注册</a> <a
                        class="btn btn_default" href="<?php ee(@$error_args['content']); ?>">返回首页</a></div>
        </div>
    </div>
</div>
<?php include config_item('root_path') . '/application/views/layout/footer.tpl.php'; ?>
</body>
</html>
