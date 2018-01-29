<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title><?php echo(config_item('site_name')); ?> - <?php e($heading); ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <?php include(APPPATH . DIRECTORY_SEPARATOR . 'views/layout/base_css.tpl.php'); ?>

</head>

<body class="gray-bg">


<div class="middle-box text-center animated fadeInDown">
    <h3 class="font-bold"><?php e($heading); ?></h3>

    <div class="error-desc">
        抱歉，错误为<?php e($message); ?>
        <form class="form-inline m-t" role="form" method="get" action="/">
            <button type="submit" class="btn btn-primary">返回</button>
        </form>
    </div>
</div>


</body>

</html>
