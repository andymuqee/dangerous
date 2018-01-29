<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title><?php echo(config_item('site_name')); ?> - 505 页面</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <?php include(APPPATH . DIRECTORY_SEPARATOR . 'views/layout/base_css.tpl.php'); ?>
</head>

<body class="gray-bg">


<div class="middle-box text-center animated fadeInDown">
    <h1>500</h1>
    <h3 class="font-bold">服务器内部错误</h3>

    <div class="error-desc">
        服务器好像出错了...
        <br/>您可以返回主页看看
        <br/><a href="/" class="btn btn-primary m-t">返回</a>
    </div>
</div>


</body>

</html>
