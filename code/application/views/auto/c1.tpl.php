<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>控制器创建第一步</title>
</head>

<body>
<form id="form1" name="form1" method="post"
      action="/auto/mqmake/c2">
    <div>
        <h1>建立控制器第一步</h1>
        <div>
            <label for="class_name">资源名：</label>
            <input type="text" id="class_name" name="class_name" value=""/>
            <label for="model_name">模型名：</label>
            <select id="model_name" name="model_name" multiple="multiple">
                <option value="0" selected="selected">选择模型名</option>
                <?php foreach ($models as $v): ?>
                    <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div>
        <input type="button" value="返回首页" onclick="javascript:window.location.href='/auto/mqmake'"/>
        <input type="submit" value="下一步"/>
    </div>
</form>
</body>
</html>